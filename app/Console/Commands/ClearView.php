<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Artisan;
class ClearView extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'use:clear';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This is clear view';

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
        
        // \Log::info('message'.\Carbon\Carbon::now() );
        $exitCode = Artisan::call('cache:clear');
        //
    }
}
