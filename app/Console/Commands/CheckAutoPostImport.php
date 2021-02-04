<?php

namespace App\Console\Commands;

use App\Jobs\AutoPostImportJob;
use Illuminate\Console\Command;

class CheckAutoPostImport extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cron:auto-post-import';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command running every hour to get latest posts from third party blog';

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
    public function handle():void
    {
        $this->line('Executing command to get latest posts from blog');
        dispatch(new AutoPostImportJob());
    }
}
