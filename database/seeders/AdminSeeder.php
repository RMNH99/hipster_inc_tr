<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       Admin::create([
        'name' => 'Admin1',
        'email' => 'admin1@gmail.com',
        'password' => Hash::make('Admin@123')
       ]);

       Admin::create([
        'name' => 'Admin2',
        'email' => 'admin2@gmail.com',
        'password' => Hash::make('Admin@123')
       ]);
    }
}
