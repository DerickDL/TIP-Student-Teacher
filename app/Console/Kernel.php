<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Console\Commands\UpdateExamStart;
use App\Console\Commands\UpdateQuizStart;
use App\Console\Commands\UpdateExamEnd;
use App\Console\Commands\UpdateQuizEnd;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        'exam:start', 
        'quiz:start', 
        'exam:end', 
        'quiz:end'
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('exam:start')->everyMinute();
        $schedule->command('exam:end')->everyMinute();
        $schedule->command('quiz:start')->everyMinute();
        $schedule->command('quiz:end')->everyMinute();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
