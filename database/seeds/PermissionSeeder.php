<?php

use Illuminate\Database\Seeder;
use App\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('permission')->delete();

        factory(App\Permission::class)->create([
            'role_name' => 'Administrator'
        ]);

        factory(App\Permission::class)->create([
            'role_name' => 'Moderator'
        ]);

        factory(App\Permission::class)->create([
            'role_name' => 'Operator'
        ]);
    }
}
