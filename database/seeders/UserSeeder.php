<?php

namespace Database\Seeders;

use DB;
use Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('users')->insert([
            [
                'name'=>'Admin 1',
                'email'=>'admin1@example.com',
                'email_verified_at'=>now(),
                'password'=>Hash::make('admin1'),
                'role'=>'admin',
            ],
            [
                'name'=>'Manager 1',
                'email'=>'manager1@example.com',
                'email_verified_at'=>now(),
                'password'=>Hash::make('manager1'),
                'role'=>'manager',
            ]
        ]);
    }
}
