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
        Commands\UpdateExamStart::class, 
        Commands\UpdateQuizStart::class, 
        Commands\UpdateExamEnd::class, 
        Commands\UpdateQuizEnd::class
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('exam:open')->everyMinute();
        $schedule->command('exam:close')->everyMinute();
        $schedule->command('quiz:open')->everyMinute();
        $schedule->command('quiz:close')->everyMinute();
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
