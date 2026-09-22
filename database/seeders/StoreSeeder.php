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
        $seller = User::where('role', 'seller')->first();

        if (!$seller) {
            $this->command->error('No seller user found.');
            return;
        }

        Store::updateOrCreate(
            [
                'seller_id' => $seller->id,
            ],
            [
                'name' => 'SecondBook Store',
                'slug' => 'secondbook-store',
                'description' => 'Official test store for SecondBook seller panel.',
                'logo' => null,
                'phone' => $seller->phone,
                'address' => $seller->address,
                'status' => 'active',
                'accept_orders' => true,
                'auto_approve_orders' => false,
                'processing_time' => 1,
                'minimum_order_amount' => 0,
                'order_note' => 'Please carefully pack the book before shipping.',
            ]
        );

        $this->command->info(
            'Seller store created successfully.'
        );
    }
}