<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Exception;

class CheckVipExpired extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:check_vip_expired';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command will help update any user vip expired';

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
        $users = User::where('vip_expired_at', '<=', now())->get();

        try {
            DB::beginTransaction();
            foreach($users as $user) {
                $user->syncRoles([]);
                $user->assignRole('member');
                $user->is_vip = false;
                $user->vip_expired_at = null;
                $user->save();
                Log::info('[REMOVE VIP LOG - ' . now() . " - " . $user->username . '] ');
            }
            Log::info('[CHECK VIP LOG - ' . now() . '] SCHEDULE CHECKING VIP RUNNING');
            DB::commit();
        } catch (Exception $e) {
            Log::error('[CHECK VIP LOG - ' . now() . ']' . $e->getMessage());
        }
    }
}
