<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Material;
use App\Models\MaterialContent;

class DebugController extends Controller
{
    public function checkImages()
    {
        // Only available in local environment
        if (!app()->environment('local')) {
            abort(403, 'This endpoint is only available in local environment');
        }

        $output = [];
        
        // Check storage link
        $output['storage_link'] = [
            'exists' => file_exists(public_path('storage')),
            'public_path' => public_path('storage'),
            'storage_path' => storage_path('app/public')
        ];
        
        if ($output['storage_link']['exists']) {
            $output['storage_link']['real_path'] = readlink(public_path('storage'));
        }
        
        // Check image directories
        $output['directories'] = [
            'public_storage_exists' => is_dir(public_path('storage')),
            'images_dir_exists' => is_dir(public_path('storage/images')),
            'materi_dir_exists' => is_dir(public_path('storage/images/materi'))
        ];
        
        // Check permissions
        $output['permissions'] = [
            'storage_dir' => substr(sprintf('%o', fileperms(public_path('storage'))), -4),
            'storage_writeable' => is_writable(public_path('storage'))
        ];
        
        if ($output['directories']['images_dir_exists']) {
            $output['permissions']['images_dir'] = substr(sprintf('%o', fileperms(public_path('storage/images'))), -4);
        }
        
        if ($output['directories']['materi_dir_exists']) {
            $output['permissions']['materi_dir'] = substr(sprintf('%o', fileperms(public_path('storage/images/materi'))), -4);
        }
        
        // Check existing images in database
        $contentWithImages = MaterialContent::whereNotNull('image_path')->get();
        $output['database_images'] = [];
        
        foreach ($contentWithImages as $content) {
            $output['database_images'][] = [
                'id' => $content->id,
                'material_id' => $content->material_id,
                'section_type' => $content->section_type,
                'image_path' => $content->image_path,
                'exists_in_storage' => Storage::disk('public')->exists($content->image_path),
                'full_url' => asset('storage/' . $content->image_path)
            ];
        }
        
        // List files in storage/images/materi
        if ($output['directories']['materi_dir_exists']) {
            $output['files_in_storage'] = Storage::disk('public')->files('images/materi');
        }
        
        return response()->json($output);
    }
    
    public function fixStorageLink()
    {
        // Only available in local environment
        if (!app()->environment('local')) {
            abort(403, 'This endpoint is only available in local environment');
        }
        
        $output = ['status' => 'unknown'];
        
        // Check if link exists
        if (file_exists(public_path('storage'))) {
            // Remove existing link
            if (is_link(public_path('storage'))) {
                unlink(public_path('storage'));
                $output['status'] = 'removed_old_link';
            } else {
                return response()->json(['error' => 'Storage path exists but is not a symlink']);
            }
        }
        
        // Create new link
        \Artisan::call('storage:link');
        $output['artisan_output'] = \Artisan::output();
        
        // Verify link was created
        $output['link_created'] = file_exists(public_path('storage'));
        
        return response()->json($output);
    }
}
