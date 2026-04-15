<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\Customer;

class CustomerSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Customer
        Customer::create([
            'name' => 'Customer',
            'email' => 'customer@example.com',
            'phone' => '0123456789',
            'address_line1' => 'No. 123, Jalan SS1/1',
            'address_line2' => 'Taman Universiti',
            'address_line3' => 'Petaling Jaya',
            'city' => 'Petaling Jaya',
            'state' => 'Selangor',
            'postal_code' => '47300',
            'country' => 'MY',
            'email_verified_at' => now(),
            'password' => Hash::make('P@ssw0rd123'),
            'is_active' => true,
            'remember_token' => Str::random(10),
        ]);
    }
}