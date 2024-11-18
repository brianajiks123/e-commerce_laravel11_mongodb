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
            // [
            //     'name'=>'Admin',
            //     'type'=>'admin',
            //     'mobile'=>'8444454754',
            //     'email'=>'admin@mail.com',
            //     'password'=>$passwd,
            //     'image'=>'',
            //     'status'=>1
            // ],
            [
                'name'=>'Brian',
                'type'=>'subadmin',
                'mobile'=>'5444454750',
                'email'=>'brian@admin.com',
                'password'=>$passwd,
                'image'=>'',
                'status'=>1
            ],
            [
                'name'=>'George',
                'type'=>'subadmin',
                'mobile'=>'5444454751',
                'email'=>'george@admin.com',
                'password'=>$passwd,
                'image'=>'',
                'status'=>1
            ],
        ];

        Admin::insert($adminRecords);
    }
}
