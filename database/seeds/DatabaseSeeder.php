<?php

use App\Pokemon;
use App\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(CategoryTableSeeder::class);
        $this->call(PermissionSeeder::class);
        $this->call(ServiceApiShortLinkSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(PostTableSeeder::class);
        $this->call(PageTableSeeder::class);
        $this->call(AdsSeeder::class);
        $this->call(SettingSeeder::class);
        factory(Pokemon::class, 100)->create();

        $role = Role::create(['name' => 'super-admin']);
        $role = Role::create(['name' => 'admin']);
        $role = Role::create(['name' => 'super-moderator']);
        $role = Role::create(['name' => 'moderator']);
        $role = Role::create(['name' => 'member']);
        $role = Role::create(['name' => 'banned']);

        $user = User::find(1);
        $user->assignRole('super-admin');
    }
}
