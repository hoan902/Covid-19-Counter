<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use \App\User;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // User::truncate(); //This drop and create table
        //Add example admin for testing using 'php artisan db:seed'
        $admin = User::create([
            'email' => 'admin@example.com',
            'password' => Hash::make('admin'),
            'user_type' => 'admin',
            'name' => 'Admin',
            'username' => 'Admin',
            'phone' => '12345678909',
            'country' => 'Vietnam',
            'id' => 1,
            'status' => 1,
            'profile_image' => 'default.jpg',
            'DoB' => '1999-12-24',
            'gender' => 'Male',
        ]);
    }
}
