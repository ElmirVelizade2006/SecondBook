<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MessageSeeder extends Seeder
{
    public function run(): void
    {
        $users = DB::table('users')
            ->where('email', '!=', 'admin@secondbook.com')
            ->where('status', true)
            ->get(['name', 'email']);

        if ($users->isEmpty()) {
            return;
        }

        $subjects = [
            'Question about my order',
            'Book condition question',
            'Shipping information',
            'Seller question',
            'Payment question',
            'Refund request',
            'General question',
            'Account assistance',
        ];

        $messages = [
            'Hello, I would like to get more information about my order.',
            'Could you please provide more details about the condition of this book?',
            'I would like to know when my order is expected to arrive.',
            'I have a question about selling books on SecondBook.',
            'Could you help me with my payment?',
            'I would like to ask about the refund process.',
            'I have a general question about the marketplace.',
            'I need some assistance with my account.',
        ];

        foreach ($users as $index => $user) {
            $subject = $subjects[$index % count($subjects)];
            $message = $messages[$index % count($messages)];

            DB::table('messages')->updateOrInsert(
                [
                    'email' => $user->email,
                    'subject' => $subject,
                ],
                [
                    'name' => $user->name,
                    'email' => $user->email,
                    'subject' => $subject,
                    'message' => $message,
                    'status' => $index % 3 === 0 ? 'unread' : 'read',
                    'updated_at' => now(),
                    'created_at' => now()->subDays(rand(1, 20)),
                ]
            );
        }
    }
}