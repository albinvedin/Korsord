<?php

namespace App\Console\Commands;

use App\Models\Word;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;

class PopulateWords extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'words:import';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Imports words to database from a file';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        if (Word::count() > 0) {
            return;
        }
        $file = "Runeberg";
        $filePath = storage_path('app/' . $file);
        $content = File::get($filePath);
        $split = explode("\n", $content);
        foreach ($split as $word) {
            Word::create([
                'word' => $word
            ]);
        }
    }
}
