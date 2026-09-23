<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WishlistSeeder extends Seeder
{
    public function run(): void
    {
        $users = DB::table('users')
            ->where('email', '!=', 'admin@secondbook.com')
            ->where('status', true)
            ->pluck('id')
            ->values();

        $books = DB::table('books')
            ->where('status', 'approved')
            ->whereNotNull('seller_id')
            ->pluck('id')
            ->values();

        if ($users->isEmpty() || $books->isEmpty()) {
            return;
        }

        $rows = [];

        foreach ($users as $userIndex => $userId) {
            for ($i = 0; $i < 3; $i++) {
                $bookId = $books[($userIndex * 3 + $i) % $books->count()];

                $rows[] = [
                    'user_id' => $userId,
                    'book_id' => $bookId,
                    'created_at' => now()->subDays(rand(1, 60)),
                    'updated_at' => now(),
                ];
            }
        }

        foreach ($rows as $row) {
            DB::table('wishlists')->updateOrInsert(
                [
                    'user_id' => $row['user_id'],
                    'book_id' => $row['book_id'],
                ],
                $row
            );
        }
    }
}