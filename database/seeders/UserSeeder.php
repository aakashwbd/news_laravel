<?php

namespace Database\Seeders;
use App\Models\User;
use Hash;

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()

        {
            User::truncate();

            User::create([
                'name'         => 'Admin',
                'email'        => 'admin@admin.com',
                'phone'        => '019000000000',
                'password'     => Hash::make('admin'),
                'user_role_id' => 1,
            ]);
            User::create([
                'name'         => 'demo',
                'email'        => 'demoadmin@gmail.com',
                'phone'        => '019000000000',
                'password'     => Hash::make('demouser'),
                'user_role_id' => 1,
            ]);
        }

}
