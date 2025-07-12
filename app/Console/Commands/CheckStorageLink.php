<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class CheckStorageLink extends Command
{
    protected $signature = 'storage:check';
    protected $description = 'Check if storage link is properly configured';

    public function handle()
    {
        $publicPath = public_path('storage');
        $storagePath = storage_path('app/public');

        if (!File::exists($publicPath)) {
            $this->error('Storage link does not exist!');
            $this->info('Run: php artisan storage:link to create it');
            return 1;
        }

        // Verify it's pointing to the correct location
        $realPath = readlink($publicPath);
        $expectedPath = $storagePath;

        $this->info("Current link: $realPath");
        $this->info("Expected link: $expectedPath");

        if (str_replace('\\', '/', $realPath) === str_replace('\\', '/', $expectedPath)) {
            $this->info('Storage link is properly configured!');
            return 0;
        } else {
            $this->error('Storage link exists but points to wrong location!');
            $this->info('Remove the link and run: php artisan storage:link again');
            return 1;
        }
    }
}
