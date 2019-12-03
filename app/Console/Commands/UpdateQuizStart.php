<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class UpdateQuizStart extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'quiz:open';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update Quiz status open';

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
        $sCurrentDateTime = Carbon::now();
        Log::debug(['quiz_start' => $sCurrentDateTime]);
        DB::table('quizzes')->where('start_datetime', '<=', $sCurrentDateTime)->where('end_datetime', '>', $sCurrentDateTime)->update(['status' => 1]);
    }
}
