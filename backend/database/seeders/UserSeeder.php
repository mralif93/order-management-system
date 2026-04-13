<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;

class UserSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Administrator
        User::create([
            'name' => 'Administrator',
            'email' => 'admin@example.com',
            'phone' => '0123456789',
            'address_line1' => 'No. 123, Jalan SS1/1',
            'address_line2' => 'Taman Universiti',
            'address_line3' => 'Petaling Jaya',
            'city' => 'Petaling Jaya',
            'state' => 'Selangor',
            'postal_code' => '47300',
            'country' => 'MY',
            'role' => 'admin',
            'email_verified_at' => now(),
            'password' => Hash::make('P@ssw0rd123'),
            'is_active' => true,
            'is_admin' => true,
            'remember_token' => Str::random(10),
        ]);

        // Owner
        User::create([
            'name' => 'Owner',
            'email' => 'owner@example.com',
            'phone' => '0123456789',
            'address_line1' => 'No. 123, Jalan SS1/1',
            'address_line2' => 'Taman Universiti',
            'address_line3' => 'Petaling Jaya',
            'city' => 'Petaling Jaya',
            'state' => 'Selangor',
            'postal_code' => '47300',
            'country' => 'MY',
            'role' => 'owner',
            'email_verified_at' => now(),
            'password' => Hash::make('P@ssw0rd123'),
            'is_active' => true,
            'is_admin' => false,
            'remember_token' => Str::random(10),
        ]);
    }
}