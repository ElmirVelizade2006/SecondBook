<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SellerApplicationSeeder extends Seeder
{
    public function run(): void
    {
        $buyers = DB::table('users')
            ->where('email', 'like', '%@secondbook.com')
            ->where('email', 'not like', 'seller%@secondbook.com')
            ->where('email', '!=', 'admin@secondbook.com')
            ->where('status', true)
            ->pluck('id')
            ->values();

        if ($buyers->isEmpty()) {
            return;
        }

        $applications = [
            [
                'store_name' => 'Readers Corner',
                'description' => 'A small online bookstore specializing in fiction and classic literature.',
                'phone' => '+994501112233',
                'address' => 'Baku, Azerbaijan',
                'status' => 'approved',
            ],
            [
                'store_name' => 'Classic Pages',
                'description' => 'A collection of classic and historical books for passionate readers.',
                'phone' => '+994502223344',
                'address' => 'Nakhchivan, Azerbaijan',
                'status' => 'approved',
            ],
            [
                'store_name' => 'Book House',
                'description' => 'Affordable books for students and everyday readers.',
                'phone' => '+994503334455',
                'address' => 'Ganja, Azerbaijan',
                'status' => 'pending',
            ],
            [
                'store_name' => 'Tech Readers',
                'description' => 'Programming, technology and professional development books.',
                'phone' => '+994504445566',
                'address' => 'Sumqayit, Azerbaijan',
                'status' => 'rejected',
            ],
        ];

        foreach ($applications as $index => $application) {
            $userId = $buyers[$index % $buyers->count()];

            DB::table('seller_applications')->updateOrInsert(
                [
                    'user_id' => $userId,
                    'store_name' => $application['store_name'],
                ],
                [
                    'user_id' => $userId,
                    'store_name' => $application['store_name'],
                    'description' => $application['description'],
                    'phone' => $application['phone'],
                    'address' => $application['address'],
                    'status' => $application['status'],
                    'rejection_reason' => $application['status'] === 'rejected'
                        ? 'The submitted store information needs additional verification.'
                        : null,
                    'reviewed_at' => $application['status'] === 'pending'
                        ? null
                        : now()->subDays(rand(1, 10)),
                    'updated_at' => now(),
                    'created_at' => now()->subDays(rand(1, 20)),
                ]
            );
        }
    }
}