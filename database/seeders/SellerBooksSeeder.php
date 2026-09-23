<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\User;
use Illuminate\Database\Seeder;

class SellerBooksSeeder extends Seeder
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

        $books = Book::orderBy('id')->get();

        if ($books->isEmpty()) {
            $this->command->error('No books found.');
            return;
        }

        foreach ($books as $index => $book) {
            $seller = $sellers[$index % $sellers->count()];

            $book->update([
                'seller_id' => $seller->id,
                'status' => 'approved',
            ]);
        }

        $this->command->info(
            $books->count() . ' books assigned to sellers successfully.'
        );
    }
}