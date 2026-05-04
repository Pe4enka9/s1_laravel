<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'phone' => '+7 (901) 600-83-38',
            'password' => Hash::make('123456'),
            'is_admin' => true,
        ]);
    }
}
