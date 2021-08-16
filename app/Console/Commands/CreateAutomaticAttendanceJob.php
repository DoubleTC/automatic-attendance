<?php

namespace App\Console\Commands;

use App\Jobs\AutomaticAttendanceJob;
use App\Models\AutomaticAttendance;
use Carbon\Carbon;
use Illuminate\Console\Command;

class CreateAutomaticAttendanceJob extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:automatic-attendance-job';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create automatic attendance job';

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
     * @return void
     */
    public function handle()
    {
        $weekMap = [
            0 => 'sunday',
            1 => 'monday',
            2 => 'tuesday',
            3 => 'wednesday',
            4 => 'thursday',
            5 => 'friday',
            6 => 'saturday',
        ];

        $now = Carbon::now();
        $dayOfWeek = $weekMap[$now->dayOfWeek];
        $atm = AutomaticAttendance::where($dayOfWeek, 1)
            ->whereTime('send_at_time', $now->format('H:i'))
            ->get();

        if ($atm->isNotEmpty()) {
            foreach ($atm as $vA) {
                AutomaticAttendanceJob::dispatch($vA);
            }
        }
    }
}
