<?php

namespace App\Console;


use Illuminate\Console\Command;
use Illuminate\Console\Scheduling\Schedule;

use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Artisan;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        'App\Console\Commands\ClearView',
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // php artisan schedule:run
        // $schedule->command('use:clear')->everyMinute();   


        \Log::info('aabbccddee  '.\Carbon\Carbon::now() );

        $schedule->call(function () {
            \Log::info('message'.\Carbon\Carbon::now() );
            Artisan::call('cache:clear');
        })->everyMinute();

        
        // })->everyFiveMinutes();
        // })->monthly();
        // })->weekly()->sundays()->at('23:50');


        // $schedule->command('inspire')->hourly();
        // $schedule->command('cache:clear')->everyMinute();
        
    }
    /**
     * php artisan schedule:run
     * /usr/local/bin/php/home/arrcosknifecom/public_html/artisan schedule:run >> /dev/null 2>&1
    */
    
    /**
     * Register the Closure based commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        require base_path('routes/console.php');
    }
}
