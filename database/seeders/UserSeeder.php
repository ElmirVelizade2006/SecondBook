<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $users = [
            [
                'name' => 'Elvin Aliyev',
                'first_name' => 'Elvin',
                'last_name' => 'Aliyev',
                'username' => 'elvin_aliyev',
                'email' => 'elvin@example.com',
                'password' => 'password',
                'role' => 'user',
                'status' => 'active',
            ],
            [
                'name' => 'Aysel Mammadova',
                'first_name' => 'Aysel',
                'last_name' => 'Mammadova',
                'username' => 'aysel_mammadova',
                'email' => 'aysel@example.com',
                'password' => 'password',
                'role' => 'user',
                'status' => 'active',
            ],
            [
                'name' => 'Murad Hasanov',
                'first_name' => 'Murad',
                'last_name' => 'Hasanov',
                'username' => 'murad_hasanov',
                'email' => 'murad@example.com',
                'password' => 'password',
                'role' => 'user',
                'status' => 'active',
            ],
            [
                'name' => 'Nigar Rahimova',
                'first_name' => 'Nigar',
                'last_name' => 'Rahimova',
                'username' => 'nigar_rahimova',
                'email' => 'nigar@example.com',
                'password' => 'password',
                'role' => 'user',
                'status' => 'active',
            ],
            [
                'name' => 'Tural Karimov',
                'first_name' => 'Tural',
                'last_name' => 'Karimov',
                'username' => 'tural_karimov',
                'email' => 'tural@example.com',
                'password' => 'password',
                'role' => 'user',
                'status' => 'active',
            ],
            [
                'name' => 'Leyla Huseynova',
                'first_name' => 'Leyla',
                'last_name' => 'Huseynova',
                'username' => 'leyla_huseynova',
                'email' => 'leyla@example.com',
                'password' => 'password',
                'role' => 'user',
                'status' => 'active',
            ],
            [
                'name' => 'Kamran Ismayilov',
                'first_name' => 'Kamran',
                'last_name' => 'Ismayilov',
                'username' => 'kamran_ismayilov',
                'email' => 'kamran@example.com',
                'password' => 'password',
                'role' => 'user',
                'status' => 'active',
            ],
            [
                'name' => 'Sabina Aliyeva',
                'first_name' => 'Sabina',
                'last_name' => 'Aliyeva',
                'username' => 'sabina_aliyeva',
                'email' => 'sabina@example.com',
                'password' => 'password',
                'role' => 'user',
                'status' => 'active',
            ],
            [
                'name' => 'Orkhan Safarov',
                'first_name' => 'Orkhan',
                'last_name' => 'Safarov',
                'username' => 'orkhan_safarov',
                'email' => 'orkhan@example.com',
                'password' => 'password',
                'role' => 'user',
                'status' => 'active',
            ],
            [
                'name' => 'Zehra Abbasova',
                'first_name' => 'Zehra',
                'last_name' => 'Abbasova',
                'username' => 'zehra_abbasova',
                'email' => 'zehra@example.com',
                'password' => 'password',
                'role' => 'user',
                'status' => 'active',
            ],
        ];

        foreach ($users as $user) {
            User::updateOrCreate(
                [
                    'username' => $user['username'],
                ],
                [
                    'name' => $user['name'],
                    'first_name' => $user['first_name'],
                    'last_name' => $user['last_name'],
                    'email' => $user['email'],
                    'password' => Hash::make($user['password']),
                    'role' => $user['role'],
                    'status' => $user['status'],
                ]
            );
        }
    }
}