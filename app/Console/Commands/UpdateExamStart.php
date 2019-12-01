<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
 
class UpdateExamStart extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'exam:open';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update Exam status to open';

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
        DB:table('quizzes')->where('start_date', '<=', $sCurrentDateTime)->update('status', 1);
    }
}
