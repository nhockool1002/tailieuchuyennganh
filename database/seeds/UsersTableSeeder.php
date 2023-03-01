<?php

use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	DB::table('users')->delete();

        factory(App\User::class)->create([
            'username' => 'XShare',
            'email' => 'xshare_community@gmail.com',
            'password' => bcrypt('0909274128'),
            'role_id' => '1'
        ]);

        factory(App\User::class)->create([
            'username' => 'nhockool1002',
            'email' => 'xshare1_community@gmail.com',
            'password' => bcrypt('0909274128'),
            'role_id' => '2'
        ]);

    //        factory(App\User::class, 30)->create();
    }
}
