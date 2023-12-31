<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $adminRecords =[
            'id'=> 1,
                'name'=>'Fatma',
                'email'=>'fatma@admin.com',
                'password'=>Hash::make('12345678'),
                'type'=>'super admin',
        ];
        Admin::create($adminRecords);
    }
}
