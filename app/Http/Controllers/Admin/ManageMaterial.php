<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Material;
use App\Traits\NotificationHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class ManageMaterial extends Controller
{
    use NotificationHelper;

    // Define available colors
    private $colors = ['blue', 'green', 'yellow', 'red', 'purple', 'orange', 'pink', 'gray', 'violet', 'indigo', 'amber', 'emerald', 'teal', 'cyan', 'sky', 'lime', 'fuchsia'];

    public function index(Request $request)
    {
        $search = $request->input('search');

        $materials = Material::when($search, function ($query, $search) {
            $query->where('title', 'like', '%' . $search . '%')
                ->orWhere('description', 'like', '%' . $search . '%');
        })->paginate(10);

        return view('pages.admin.materials', compact('materials'));
    }

    public function store(Request $request)
    {
        DB::beginTransaction();

        try {
            Log::info('Request data:', $request->all());
            
            $validated = $request->validate([
                'title' => 'required|string|max:255',
                'description' => 'required|string',
                'difficulty_level' => 'required|in:mudah,sedang,sulit',
                'contents' => 'required|array',
                'contents.*.id' => 'nullable|exists:material_contents,id',
                'contents.*.section_type' => 'required|in:pengenalan,materi_utama',
                'contents.*.title' => 'required|string|max:255',
                'contents.*.content' => 'required|string',
                'contents.*.image' => 'nullable|image|max:2048',
                'color' => 'required|in:' . implode(',', $this->colors),
            ]);

            Log::info('Validated data:', $validated);
            
            $color = $validated['color'];

            $material = Material::create([
                'title' => $validated['title'],
                'description' => $validated['description'],
                'difficulty_level' => $validated['difficulty_level'],
                'color' => $color,
            ]);

            Log::info('Material created:', $material->toArray());

            foreach ($validated['contents'] as $index => $content) {
                // Skip entries that don't have titles (could happen with dynamic forms)
                if (!isset($content['title'])) {
                    continue;
                }
                
                $imagePath = null;
                if (isset($content['image']) && $content['image'] instanceof \Illuminate\Http\UploadedFile) {
                    // Store image in public disk with 'images/materi' path
                    $imagePath = $content['image']->store('images/materi', 'public');
                    
                    // Log the image path for debugging
                    Log::info("Image stored at: {$imagePath}");
                    
                    // Verify the file exists in storage
                    if (!Storage::disk('public')->exists($imagePath)) {
                        Log::warning("Image does not exist at storage path: {$imagePath}");
                    }
                }

                $newContent = $material->contents()->create([
                    'section_type' => $content['section_type'],
                    'title' => $content['title'],
                    'content' => $content['content'],
                    'audio_text' => $content['audio_text'] ?? null,
                    'image_path' => $imagePath
                ]);
                
                Log::info("Content {$index} created:", $newContent->toArray());
            }

            DB::commit();
            
            Log::info('Transaction committed successfully');

            Auth::user()->logActivity(
                'Materi Dibuat',
                "Admin telah membuat materi baru: {$material->title}",
                'material_created'
            );

            $this->sendNotification(
                'Materi Baru Tersedia',
                "Materi baru telah ditambahkan: {$material->title}",
                'material_added',
                'fa-book',
                'green'
            );

            return redirect()->route('admin.materials.index')->with('success', 'Materi berhasil dibuat');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error creating material: ' . $e->getMessage());
            Log::error($e->getTraceAsString());
            return redirect()->back()->with('error', 'Terjadi kesalahan saat membuat materi: ' . $e->getMessage())->withInput();
        }
    }

    public function edit(Material $material)
    {
        $material->load('contents');
        return response()->json([
            'id' => $material->id,
            'title' => $material->title,
            'description' => $material->description,
            'difficulty_level' => $material->difficulty_level,
            'color' => $material->color,
            'contents' => $material->contents->map(function ($content) {
                return [
                    'id' => $content->id,
                    'section_type' => $content->section_type,
                    'title' => $content->title,
                    'content' => $content->content,
                    'audio_text' => $content->audio_text,
                    'image_path' => $content->image_path
                ];
            })
        ]);
    }

    public function update(Request $request, Material $material)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'difficulty_level' => 'required|in:mudah,sedang,sulit',
            'color' => 'required|in:' . implode(',', $this->colors),
            'contents' => 'required|array',
            'contents.*.id' => 'nullable|exists:material_contents,id',
            'contents.*.section_type' => 'required|in:pengenalan,materi_utama,latihan',
            'contents.*.title' => 'required|string|max:255',
            'contents.*.content' => 'required|string',
            'contents.*.audio_text' => 'nullable|string',
            'contents.*.image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'delete_content' => 'nullable|array',
            'delete_content.*' => 'exists:material_contents,id',
        ]);

        try {
            DB::beginTransaction();

            $oldTitle = $material->title;
            $oldDescription = $material->description;
            
            $material->update([
                'title' => $validated['title'],
                'description' => $validated['description'],
                'difficulty_level' => $validated['difficulty_level'],
                'color' => $validated['color'],
            ]);

            // Get existing content for comparison
            $existingContents = $material->contents->keyBy('id')->toArray();

            // Handle content deletions
            if (isset($request->delete_content) && is_array($request->delete_content)) {
                foreach ($request->delete_content as $contentId) {
                    $contentToDelete = $material->contents()->find($contentId);
                    if ($contentToDelete) {
                        // Delete associated image if exists
                        if ($contentToDelete->image_path && Storage::disk('public')->exists($contentToDelete->image_path)) {
                            Storage::disk('public')->delete($contentToDelete->image_path);
                            Log::info("Deleted image for removed content: {$contentToDelete->image_path}");
                        }
                        $contentToDelete->delete();
                        Log::info("Deleted content ID: {$contentId}");
                    }
                }
            }

            // Handle image deletions for existing content
            if (isset($request->delete_image_for_content) && is_array($request->delete_image_for_content)) {
                foreach ($request->delete_image_for_content as $contentId => $value) {
                    if ($value === '1') {
                        $contentToUpdate = $material->contents()->find($contentId);
                        if ($contentToUpdate && $contentToUpdate->image_path) {
                            if (Storage::disk('public')->exists($contentToUpdate->image_path)) {
                                Storage::disk('public')->delete($contentToUpdate->image_path);
                                Log::info("Deleted image for content: {$contentToUpdate->image_path}");
                            }
                            $contentToUpdate->update(['image_path' => null]);
                        }
                    }
                }
            }

            // Process all contents (update existing and create new)
            foreach ($validated['contents'] as $content) {
                // Skip entries without title (could happen with dynamic forms)
                if (!isset($content['title'])) {
                    continue;
                }
                
                $imagePath = null;
                $existingContent = isset($content['id']) ? $material->contents->find($content['id']) : null;

                // Handle image upload or deletion
                if (isset($content['image']) && $content['image'] instanceof \Illuminate\Http\UploadedFile) {
                    // Delete old image if it exists
                    if ($existingContent && $existingContent->image_path) {
                        if (Storage::disk('public')->exists($existingContent->image_path)) {
                            Storage::disk('public')->delete($existingContent->image_path);
                            Log::info("Deleted old image: {$existingContent->image_path}");
                        }
                    }
                    
                    // Store new image
                    $imagePath = $content['image']->store('images/materi', 'public');
                    Log::info("New image stored at: {$imagePath}");
                } else if ($existingContent) {
                    // Check if delete_image flag is set
                    if (isset($content['delete_image']) && $content['delete_image']) {
                        if ($existingContent->image_path && Storage::disk('public')->exists($existingContent->image_path)) {
                            Storage::disk('public')->delete($existingContent->image_path);
                            Log::info("Deleted image due to delete flag: {$existingContent->image_path}");
                        }
                        $imagePath = null;
                    } else {
                        // Keep existing image if not being replaced or deleted
                        $imagePath = $existingContent->image_path;
                    }
                }

                $contentData = [
                    'section_type' => $content['section_type'],
                    'title' => $content['title'],
                    'content' => $content['content'],
                    'audio_text' => $content['audio_text'] ?? null,
                    'image_path' => $imagePath,
                ];

                // Update existing content or create new
                if (isset($content['id']) && $existingContent) {
                    $material->contents()->where('id', $content['id'])->update($contentData);
                    Log::info("Updated content ID: {$content['id']}");
                } else {
                    $newContent = $material->contents()->create($contentData);
                    Log::info("Created new content ID: {$newContent->id}");
                }
            }

            DB::commit();

            // Determine what changed for activity logging
            $changes = [];

            if ($oldTitle !== $validated['title']) {
                $changes[] = "Judul dari '{$oldTitle}' menjadi '{$validated['title']}'";
            }
            if ($oldDescription !== $validated['description']) {
                $changes[] = "Deskripsi materi '{$material->title}'";
            }
            if ($material->getOriginal('color') !== $validated['color']) {
                $changes[] = "Warna materi '{$material->title}'";
            }

            // Check if content has changed
            $contentChanged = isset($request->delete_content) || isset($request->delete_image_for_content);
            if (!$contentChanged) {
                foreach ($validated['contents'] as $newContent) {
                    if (isset($newContent['id'])) {
                        $oldContent = $existingContents[$newContent['id']] ?? null;
                        if ($oldContent && ($oldContent['content'] !== $newContent['content'] || $oldContent['title'] !== $newContent['title'])) {
                            $contentChanged = true;
                            break;
                        }
                    } else {
                        // New content added
                        $contentChanged = true;
                        break;
                    }
                }
            }

            if ($contentChanged) {
                $changes[] = "konten materi '{$material->title}'";
            }

            $message = $changes ? "Admin telah memperbarui " . implode(', ', $changes) : "Admin telah memperbarui materi '{$material->title}'";

            Auth::user()->logActivity(
                'Materi Diperbarui',
                $message,
                'material_updated'
            );

            $this->sendNotification(
                'Materi Diperbarui',
                "Materi telah diperbarui: {$material->title}",
                'material_updated',
                'fa-edit',
                'blue'
            );

            return redirect()->route('admin.materials.index')->with('success', 'Materi berhasil diperbarui');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error updating material: ' . $e->getMessage());
            Log::error($e->getTraceAsString());
            return back()->with('error', 'Terjadi kesalahan saat memperbarui materi: ' . $e->getMessage());
        }
    }

    public function destroy(Material $material)
    {
        try {
            DB::beginTransaction();
            foreach ($material->contents as $content) {
                if ($content->image_path) {
                    Storage::disk('public')->delete($content->image_path);
                }
            }

            $material->contents()->delete();
            $material->delete();

            DB::commit();

            Auth::user()->logActivity(
                'Materi Dihapus',
                "Admin telah menghapus materi: {$material->title}",
                'material_deleted'
            );

            $this->sendNotification(
                'Materi Dihapus',
                "Materi telah dihapus: {$material->title}",
                'material_deleted',
                'fa-trash',
                'red'
            );

            return redirect()->route('admin.materials.index')->with('success', 'Materi berhasil dihapus.');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error deleting material: ' . $e->getMessage());
            return back()->with('error', 'Terjadi kesalahan saat menghapus materi: ' . $e->getMessage());
        }
    }

    public function toggleStatus(Material $material)
    {
        try {
            $material->update([
                'is_active' => !$material->is_active
            ]);

            Auth::user()->logActivity(
                'Status Materi Diubah',
                "Admin telah mengubah status materi: {$material->title}",
                'material_status_updated'
            );

            return response()->json([
                'success' => true,
                'status' => $material->is_active,
                'message' => $material->is_active ? 'Materi diaktifkan.' : 'Materi dinonaktifkan.'
            ]);
        } catch (\Exception $e) {
            Log::error('Error toggling material status: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat mengubah status materi: ' . $e->getMessage()
            ], 500);
        }
    }
    
    public function detail(Material $material)
    {
        $material->load([
            'contents',
            'materialProgress.user'
        ]);

        return response()->json([
            'id' => $material->id,
            'title' => $material->title,
            'description' => $material->description,
            'difficulty_level' => $material->difficulty_level,
            'color' => $material->color,
            'is_active' => $material->is_active,
            'created_at' => $material->created_at,
            'contents' => $material->contents->map(function($content) {
                return [
                    'id' => $content->id,
                    'section_type' => $content->section_type,
                    'title' => $content->title,
                    'content' => $content->content,
                    'audio_text' => $content->audio_text,
                    'image_path' => $content->image_path,
                ];
            }),
            'user_progress' => $material->materialProgress->map(function($progress) {
                return [
                    'is_started' => $progress->is_started,
                    'is_completed' => $progress->is_completed,
                    'completed_at' => $progress->completed_at,
                    'user' => [
                        'id' => $progress->user->id,
                        'name' => $progress->user->name,
                        'email' => $progress->user->email,
                    ]
                ];
            })
        ]);
    }
}