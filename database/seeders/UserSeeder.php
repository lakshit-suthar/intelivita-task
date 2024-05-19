<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Admin;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $adminObj = new Admin();
        $adminObj->name = 'Admin';
        $adminObj->email = 'admin@yopmail.com';
        $adminObj->password = Hash::make('123456789');
        $adminObj->save();

        $userObj = new User();
        $userObj->name = 'User';
        $userObj->email = 'lakshit@yopmail.com';
        $userObj->password = Hash::make('123456789');
        $userObj->save();


    }
}
