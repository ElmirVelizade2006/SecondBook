<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BannerSeeder extends Seeder
{
    public function run(): void
    {
        $banners = [
            [
                'title' => 'Discover Your Next Book',
                'subtitle' => 'Explore thousands of new and pre-owned books.',
                'image' => 'https://images.unsplash.com/photo-1507842217343-583bb7270b66?auto=format&fit=crop&w=1600&q=85',
                'button_text' => 'Shop Books',
                'button_url' => '/books',
                'position' => 1,
            ],
            [
                'title' => 'Give Books a Second Life',
                'subtitle' => 'Sell your books and connect with readers.',
                'image' => 'https://images.unsplash.com/photo-1524995997946-a1c2e315a42f?auto=format&fit=crop&w=1600&q=85',
                'button_text' => 'Become a Seller',
                'button_url' => '/seller/apply',
                'position' => 2,
            ],
            [
                'title' => 'Build Your Personal Library',
                'subtitle' => 'Find classics, fiction, technology and more.',
                'image' => 'https://images.unsplash.com/photo-1512820790803-83ca734da794?auto=format&fit=crop&w=1600&q=85',
                'button_text' => 'Explore',
                'button_url' => '/books',
                'position' => 3,
            ],
        ];

        foreach ($banners as $banner) {
            DB::table('banners')->updateOrInsert(
                ['title' => $banner['title']],
                array_merge($banner, [
                    'status' => 'active',
                    'updated_at' => now(),
                    'created_at' => now(),
                ])
            );
        }
    }
}