<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NotificationSeeder extends Seeder
{
    public function run(): void
    {
        $users = DB::table('users')
            ->where('status', true)
            ->pluck('id');

        if ($users->isEmpty()) {
            return;
        }

        $notifications = [
            [
                'type' => 'order',
                'title' => 'Order Confirmed',
                'message' => 'Your order has been successfully confirmed.',
                'read_at' => null,
            ],
            [
                'type' => 'order',
                'title' => 'Order Shipped',
                'message' => 'Your book order has been shipped.',
                'read_at' => now()->subDays(2),
            ],
            [
                'type' => 'general',
                'title' => 'Welcome to SecondBook',
                'message' => 'Welcome to SecondBook. Start exploring our marketplace today.',
                'read_at' => now()->subDays(5),
            ],
            [
                'type' => 'promotion',
                'title' => 'New Discount Available',
                'message' => 'A new discount coupon is available in the marketplace.',
                'read_at' => null,
            ],
        ];

        foreach ($users as $userId) {
            foreach ($notifications as $notification) {
                DB::table('notifications')->insert([
                    'user_id' => $userId,
                    'type' => $notification['type'],
                    'title' => $notification['title'],
                    'message' => $notification['message'],
                    'read_at' => $notification['read_at'],
                    'created_at' => now()->subDays(rand(1, 15)),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}