<?php

namespace App\Console\Commands;

use App\Models\FileDraft;
use Illuminate\Console\Command;

class ClearFileDrafts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:clear-file-drafts';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clear file drafts table and corresponding images';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $fileDrafts = FileDraft::all();

        foreach ($fileDrafts as $fileDraft) {
            unlink(storage_path("app/" . $fileDraft->path));
        }

        FileDraft::truncate();

        $this->info('File drafts and corresponding images cleared successfully.');
    }
}
