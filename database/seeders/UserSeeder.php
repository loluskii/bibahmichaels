<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'fname' => 'Test',
            'lname' => 'User',
            'email' => 'test@email.com',
            'email_verified_at' => now(),
            'is_admin' =>  1,
            'password' => Hash::make('password'), // aur2611
            'remember_token' => Str::random(10),
        ]);
    }
}
