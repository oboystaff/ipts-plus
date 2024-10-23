<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::firstOrCreate([
            'email' => 'admin@acn.com',
        ], [
            'name' => 'Admin User',
            'phone' => '0271115628',
            'password' => Hash::make('password'),
        ]);
    }
}