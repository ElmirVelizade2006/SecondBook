<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        /*
        |--------------------------------------------------------------------------
        | Admin
        |--------------------------------------------------------------------------
        */

        User::updateOrCreate(
            ['email' => 'admin@secondbook.test'],
            [
                'name' => 'SecondBook Admin',
                'first_name' => 'SecondBook',
                'last_name' => 'Admin',
                'username' => 'admin',
                'password' => 'password',
                'role' => 'admin',
                'status' => 'active',
                'email_verified_at' => now(),
                'profile_visibility' => true,
                'receive_email_notifications' => true,
                'receive_order_updates' => true,
                'receive_promotional_emails' => false,
            ]
        );

        /*
        |--------------------------------------------------------------------------
        | Sellers
        |--------------------------------------------------------------------------
        */

        $sellers = [
            [
                'first_name' => 'Ali',
                'last_name' => 'Mammadov',
                'username' => 'seller_ali',
                'email' => 'seller.ali@secondbook.test',
                'photo' => 'https://randomuser.me/api/portraits/men/32.jpg',
            ],
            [
                'first_name' => 'Nigar',
                'last_name' => 'Hasanli',
                'username' => 'seller_nigar',
                'email' => 'seller.nigar@secondbook.test',
                'photo' => 'https://randomuser.me/api/portraits/women/44.jpg',
            ],
            [
                'first_name' => 'Rauf',
                'last_name' => 'Karimov',
                'username' => 'seller_rauf',
                'email' => 'seller.rauf@secondbook.test',
                'photo' => 'https://randomuser.me/api/portraits/men/46.jpg',
            ],
            [
                'first_name' => 'Aysel',
                'last_name' => 'Quliyeva',
                'username' => 'seller_aysel',
                'email' => 'seller.aysel@secondbook.test',
                'photo' => 'https://randomuser.me/api/portraits/women/65.jpg',
            ],
            [
                'first_name' => 'Murad',
                'last_name' => 'Aliyev',
                'username' => 'seller_murad',
                'email' => 'seller.murad@secondbook.test',
                'photo' => 'https://randomuser.me/api/portraits/men/75.jpg',
            ],
        ];

        foreach ($sellers as $seller) {
            User::updateOrCreate(
                ['email' => $seller['email']],
                [
                    'name' => $seller['first_name'] . ' ' . $seller['last_name'],
                    'first_name' => $seller['first_name'],
                    'last_name' => $seller['last_name'],
                    'username' => $seller['username'],
                    'password' => 'password',
                    'role' => 'seller',
                    'status' => 'active',
                    'email_verified_at' => now(),
                    'profile_photo' => $seller['photo'],
                    'profile_visibility' => true,
                    'receive_email_notifications' => true,
                    'receive_order_updates' => true,
                    'receive_promotional_emails' => false,
                ]
            );
        }

        /*
        |--------------------------------------------------------------------------
        | Buyers
        |--------------------------------------------------------------------------
        */

        $buyers = [
            ['Elvin', 'Aliyev', 'elvin_aliyev', 'elvin@example.com'],
            ['Aysel', 'Mammadova', 'aysel_mammadova', 'aysel@example.com'],
            ['Murad', 'Hasanov', 'murad_hasanov', 'murad@example.com'],
            ['Nigar', 'Rahimova', 'nigar_rahimova', 'nigar@example.com'],
            ['Tural', 'Karimov', 'tural_karimov', 'tural@example.com'],
            ['Leyla', 'Huseynova', 'leyla_huseynova', 'leyla@example.com'],
            ['Kamran', 'Ismayilov', 'kamran_ismayilov', 'kamran@example.com'],
            ['Sabina', 'Aliyeva', 'sabina_aliyeva', 'sabina@example.com'],
            ['Orkhan', 'Safarov', 'orkhan_safarov', 'orkhan@example.com'],
            ['Zehra', 'Abbasova', 'zehra_abbasova', 'zehra@example.com'],
        ];

        foreach ($buyers as $index => $buyer) {
            User::updateOrCreate(
                ['email' => $buyer[3]],
                [
                    'name' => $buyer[0] . ' ' . $buyer[1],
                    'first_name' => $buyer[0],
                    'last_name' => $buyer[1],
                    'username' => $buyer[2],
                    'password' => 'password',
                    'role' => 'user',
                    'status' => 'active',
                    'email_verified_at' => now(),
                    'profile_visibility' => true,
                    'receive_email_notifications' => true,
                    'receive_order_updates' => true,
                    'receive_promotional_emails' => false,
                ]
            );
        }

        $this->command->info('Users, sellers and buyers seeded successfully.');
    }
}