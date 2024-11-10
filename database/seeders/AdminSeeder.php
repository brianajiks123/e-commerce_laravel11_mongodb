<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $passwd = Hash::make('12345678');

        $adminRecords = [
            [
                'name'=>'Admin',
                'type'=>'admin',
                'mobile'=>'8444454754',
                'email'=>'admin@mail.com',
                'password'=>$passwd,
                'image'=>'',
                'status'=>1
            ]
        ];

        Admin::insert($adminRecords);
    }
}
