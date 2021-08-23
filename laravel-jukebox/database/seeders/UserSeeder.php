<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{

    public function run()
    {

        //CMD + OPT + L Reformatin
        //CMD + D Dublicate Line/ Selection
        $seedUsers = [
            [
//            'id' => 1,
                'name' => 'Ad Minister',
                'email' => 'admin@example.com',
                'email_verified_at' => now(),
                'password' => Hash::make('Password1'),
                'created_at' => now(),
            ],
            [
//            'id' => 2,
                'name' => 'EROL A\'NIL',
                'email' => 'given@example.com',
                'email_verified_at' => now(),
                'password' => Hash::make('Password1'),
                'created_at' => now(),
            ],
            [
//            'id' => 3, //'id'=> null,
                'name' => 'Eileen Dover',
                'email' => 'eileen@example.com',
                'email_verified_at' => now(),
                'password' => Hash::make('Password1'),
                'created_at' => now(),
            ],
            [
//            'id' => 3, //'id'=> null,
                'name' => 'Jacques d\'Carre',
                'email' => 'jacques@example.com',
                'email_verified_at' => now(),
                'password' => Hash::make('Password1'),
                'created_at' => now(),
            ],
        ];

        foreach ($seedUsers as $seed) {
            User::create($seed);
        }
    }
}
