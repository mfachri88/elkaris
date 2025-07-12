<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Material;
use App\Models\MaterialProgress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MaterialController extends Controller
{
    public function index()
    {
        $materi = Material::where('is_active', true)
            ->with(['progress' => function ($query) {
                $query->where('user_id', Auth::id());
            }])->get();

        $totalMateri = $materi->count();
        $completedMateri = $materi->filter(function ($item) {
            return $item->progress && $item->progress->is_completed;
        })->count();

        return view('pages.materi', compact('materi', 'totalMateri', 'completedMateri'));
    }

    public function show($id)
    {
        $materi = Material::with(['contents' => function ($query) {
            $query->orderBy('section_type', 'asc');
        }])->findOrFail($id);

        return view('pages.materi.detail', compact('materi'));
    }

    public function search(Request $request)
    {
        $keyword = $request->get('keyword');

        if (!$keyword) return response()->json([]);

        $results = Material::where('is_active', true)
            ->where(function($query) use ($keyword) {
                $query->where('title', 'like', "%{$keyword}%")
                      ->orWhere('description', 'like', "%{$keyword}%");
            })
            ->select('id', 'title', 'description')
            ->limit(5)
            ->get();

        return response()->json($results);
    }

    public function showIntroduction($id)
    {
        $materi = Material::with(['contents' => function ($query) {
            $query->where('section_type', 'pengenalan');
        }])->findOrFail($id);

        $introduction = $materi->contents->first();
        if (!$introduction) return redirect()->back()->with('error', 'Konten pengenalan tidak ditemukan');
        $this->markMaterialAsStarted($id);

        return view('components.materi.pengenalan', compact('materi', 'introduction'));

    }

    public function showMainContent($id)
    {
        $materi = Material::with(['contents' => function ($query) {
            $query->where('section_type', 'materi_utama');
        }])->findOrFail($id);

        // Ambil semua konten materi utama, tidak hanya yang pertama
        $mainContents = $materi->contents; // Ini akan berisi semua materi utama
        
        $this->markMaterialAsStarted($id);
        
        return view('components.materi.materi-utama', compact('materi', 'mainContents'));
    }

    

    private function markMaterialAsStarted($materialId)
    {
        $progress = MaterialProgress::firstOrCreate([
            'user_id' => Auth::id(),
            'material_id' => $materialId
        ]);

        if (!$progress->is_started) {
            $progress->is_started = true;
            $progress->save();
        }
    }

    public function completeContent($id)
    {
        try {
            $progress = MaterialProgress::firstOrNew([
                'user_id' => Auth::id(),
                'material_id' => $id
            ]);

            if (!$progress->is_completed) {
                $progress->is_started = true;
                $progress->is_completed = true;
                $progress->completed_at = now();
                $progress->save();

                $material = Material::find($id);
                Auth::user()->logActivity(
                    'Materi Selesai',
                    Auth::user()->name . " telah menyelesaikan materi {$material->title}",
                    'material_completed'
                );

                return response()->json([
                    'status' => 'success',
                    'message' => 'Materi berhasil diselesaikan'
                ]);
            }

            return response()->json([
                'status' => 'info',
                'message' => 'Materi sudah pernah diselesaikan'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Terjadi kesalahan saat menyelesaikan materi'
            ], 500);
        }
    }
}