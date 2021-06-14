<?php

use App\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = Carbon::now();
        
        $users = [
            // admin
            [
                'username' => 'admin',
                'firstname' => 'admin',
                'lastname' => 'admin',
                'email' => 'admin@coffee.com',
                'password' => Hash::make('admin123'),
                'email_verified_at' => $now,
            ],

            // satya
            [
                'username' => 'satya',
                'firstname' => 'tann',
                'lastname' => 'veraksatya',
                'email' => 'satya@coffee.com',
                'password' => Hash::make('satya123'),
                'email_verified_at' => $now,
            ],

            // 

        ];

        // save records
        foreach ($users as $user){
            User::create($user);
        }

    }
}
