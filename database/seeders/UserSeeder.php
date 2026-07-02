<?php

namespace Database\Seeders;

use App\Models\User\RoleEnum;
use App\Models\User\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $users = [
            [
                'phone' => '+7 (000) 000-00-00',
                'password' => Hash::make('123456'),
                'name' => 'Иван',
                'role' => RoleEnum::OWNER,
            ],
            [
                'phone' => '+7 (111) 111-11-11',
                'password' => Hash::make('123456'),
                'name' => 'Сергей',
                'role' => RoleEnum::ADMIN,
            ],
            [
                'phone' => '+7 (222) 222-22-22',
                'password' => Hash::make('123456'),
                'name' => 'Михаил',
                'role' => RoleEnum::ADMIN,
            ],
            [
                'phone' => '+7 (333) 333-33-33',
                'password' => Hash::make('123456'),
                'name' => 'Максим',
                'role' => RoleEnum::ADMIN,
            ],
        ];

        foreach ($users as $user) {
            User::create($user);
        }
    }
}
