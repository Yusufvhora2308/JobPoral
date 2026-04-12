<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Str;
class Adminseeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //

         DB::table('users')->insert([
            'name' => 'Super Admin',
            'email' => 'Admin2308@gmail.com',
            'password' => Hash::make('Admin@123'), // secure password
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
