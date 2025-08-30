<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;
use App\Models\Customer;

class CustSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $f = Faker::create();

        foreach(range(1, 10) as $cust)
        {
            Customer::create([
                'name' => $f->name,
                'email' => $f->unique()->safeEmail,
                'password' => Hash::make('Customer@123'),
                'is_online' => $f->boolean
            ]);
        }
    }
}
