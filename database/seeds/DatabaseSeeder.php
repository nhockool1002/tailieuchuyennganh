<?php

use App\Pokemon;
use Illuminate\Database\Seeder;

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
    }
}
