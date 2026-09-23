<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MessageReplySeeder extends Seeder
{
    public function run(): void
    {
        $adminId = DB::table('users')
            ->where('email', 'admin@secondbook.com')
            ->value('id');

        $messages = DB::table('messages')
            ->orderBy('id')
            ->get();

        if ($messages->isEmpty()) {
            return;
        }

        $replies = [
            'Thank you for contacting SecondBook. We are happy to help.',
            'Thank you for your message. We have checked the information and will assist you shortly.',
            'Your request has been received. Please let us know if you need anything else.',
            'We appreciate you contacting our support team.',
        ];

        foreach ($messages as $index => $message) {
            DB::table('message_replies')->updateOrInsert(
                [
                    'message_id' => $message->id,
                    'reply' => $replies[$index % count($replies)],
                ],
                [
                    'message_id' => $message->id,
                    'user_id' => $adminId,
                    'sender_type' => 'admin',
                    'reply' => $replies[$index % count($replies)],
                    'updated_at' => now(),
                    'created_at' => now()->subDays(rand(1, 10)),
                ]
            );
        }
    }
}