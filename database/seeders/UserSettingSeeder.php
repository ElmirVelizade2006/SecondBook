<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSettingSeeder extends Seeder
{
    public function run(): void
    {
        $users = DB::table('users')
            ->where('status', true)
            ->pluck('id');

        foreach ($users as $index => $userId) {
            DB::table('user_settings')->updateOrInsert(
                ['user_id' => $userId],
                [
                    'user_id' => $userId,
                    'email_notifications' => true,
                    'order_updates' => true,
                    'promotional_emails' => $index % 3 !== 0,
                    'profile_visible' => true,
                    'updated_at' => now(),
                    'created_at' => now(),
                ]
            );
        }
    }
}