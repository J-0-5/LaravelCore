<?php

use App\Modules\UserModule\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $users =
            [
                1 => [
                    "Admin",
                    "CORE",
                    "admin@core.co",
                    3000000,
                    Hash::make("Core20**"),
                    1,
                    1,
                ],
            ];

        foreach ($users as $id => $user) {
            User::create([
                "name" => $user[0],
                "last_name" => $user[1],
                "email" => $user[2],
                "phone" => $user[3],
                "password" => $user[4],
                "active" => $user[5],
                'role_id' => $user[6],
            ]);
        }
    }
}
