<?php

namespace App\Console\Commands;

use App\Models\News;
use Illuminate\Console\Command;

class TestCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:custom_test';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description for Custom Test Command';

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
     * @return int
     */
    public function handle()
    {
        $this->info("Custom task started.");
        $this->info("Do something...");
        $news = News::find(1);
        $this->info($news);
        $this->info("Custom task ended.");
        return 0;
    }
}
