<?php

namespace Database\Seeders;

use App\Models\Store;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class StoreSeeder extends Seeder
{
    public function run(): void
    {
        $sellers = User::where('role', 'seller')
            ->orderBy('id')
            ->get();

        if ($sellers->isEmpty()) {
            $this->command->error('No sellers found.');
            return;
        }

        $storeNames = [
            'Ali Books',
            'Nigar Reading House',
            'Rauf Book Market',
            'Aysel Book Corner',
            'Murad Readers Store',
        ];

        foreach ($sellers as $index => $seller) {
            $name = $storeNames[$index % count($storeNames)];

            Store::updateOrCreate(
                ['seller_id' => $seller->id],
                [
                    'name' => $name,
                    'slug' => Str::slug($name),
                    'description' => 'A trusted SecondBook marketplace store.',
                    'logo' => null,
                    'phone' => '+994500000000',
                    'address' => 'Baku, Azerbaijan',
                    'status' => 'active',
                    'accept_orders' => true,
                    'auto_approve_orders' => false,
                    'processing_time' => rand(1, 3),
                    'minimum_order_amount' => 0,
                    'order_note' => 'Books are carefully packed before shipping.',
                ]
            );
        }

        $this->command->info(
            $sellers->count() . ' seller stores seeded successfully.'
        );
    }
}