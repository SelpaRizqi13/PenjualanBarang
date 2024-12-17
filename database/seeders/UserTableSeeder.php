<?php

namespace Database\Seeders;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
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
            [
                'name' => 'Admin',
                'email' => 'admin@gmail.com',
                'role' => 'admin',
                'password' => '$2y$10$J0H0hm.KPDheYJF/x1W3EO6RvxyMt/HSpq3EWR1j3.wJ6qevWRU7e', //qwerty123
            ],
            [
                'name' => 'Super Admin',
                'email' => 'suadmin@gmail.com',
                'role' => 'super admin',
                'password' => '$2y$10$J0H0hm.KPDheYJF/x1W3EO6RvxyMt/HSpq3EWR1j3.wJ6qevWRU7e', //qwerty123
            ],
            ];
        foreach ($users as $user) {
            User::create($user);
        }
    }
}
