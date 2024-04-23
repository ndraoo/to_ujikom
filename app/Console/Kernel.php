<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Carbon\Carbon;
use App\Models\peminjaman;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        $schedule->call(function () {
            peminjaman::where('tanggal_pengembalian', '<', Carbon::now())
                ->where('status_peminjaman', '!=', 'Dikembalikan')
                ->get()
                ->each(function ($peminjaman) {
                    $peminjaman->periksaStatusPengembalian();
                });
        })->hourly();
    }
    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
