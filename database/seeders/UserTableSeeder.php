<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        \DB::table('users')->insert([
            'name' => 'Administrator',
            'role' => 'administrator',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('Admin@123'),
            'is_visible' => '1'
        ]);
    }
}
