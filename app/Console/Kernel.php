<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\User;
use Illuminate\Support\Facades\Log;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')
        //          ->hourly();
        // $schedule->call(function () {
        //     // Xóa quyền VIP của tất cả các user hết hạn
        //     $users = User::where('vip_expired_at', '<=', now());
        //     $users->update(['is_vip' => false, 'vip_expired_at' => null]);
        //     if ($users) {
        //         foreach($users as $user) {
        //             $user->syncRoles([]);
        //             $user->assignRole('member');
        //         }
        //     }
        //     Log::info('[CHECK VIP LOG - ' . now() . '] SCHEDULE CHECKING VIP RUNNING');
        // })->hourly();
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
