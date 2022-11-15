<?php

// use Database\Seeders\ExternalCallSeeder;
// use Database\Seeders\GroupSeeder;
// use Database\Seeders\MemberSeeder;
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
        $this->call([
            ParameterValueSeeder::class,
            RoleSeeder::class,
            UserSeeder::class,
            ModuleSeeder::class,
        ]);
    }
}
