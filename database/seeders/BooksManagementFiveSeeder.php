<?php

namespace Database\Seeders;

use App\Models\Author;
use App\Models\Book;
use App\Models\Category;
use App\Models\Publisher;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class BooksManagementFiveSeeder extends Seeder
{
    /**
     * Seed 5 records for books-management database tables.
     */
    public function run(): void
    {
        $categoryNames = [
            'Fiction',
            'Non-Fiction',
            'Science',
            'History',
            'Technology',
        ];

        $authorNames = [
            'George Orwell',
            'Jane Austen',
            'Yuval Noah Harari',
            'Agatha Christie',
            'Robert C. Martin',
        ];

        $publisherRows = [
            ['name' => 'Penguin Books', 'country' => 'UK', 'website' => 'https://www.penguin.com'],
            ['name' => 'HarperCollins', 'country' => 'USA', 'website' => 'https://www.harpercollins.com'],
            ['name' => "O'Reilly Media", 'country' => 'USA', 'website' => 'https://www.oreilly.com'],
            ['name' => 'Bloomsbury', 'country' => 'UK', 'website' => 'https://www.bloomsbury.com'],
            ['name' => 'Vintage', 'country' => 'USA', 'website' => 'https://www.vintagebooks.com'],
        ];

        $sellerRows = [
            ['first_name' => 'Ali', 'last_name' => 'Mammadov', 'username' => 'seller_ali', 'email' => 'seller.ali@secondbook.test'],
            ['first_name' => 'Nigar', 'last_name' => 'Hasanli', 'username' => 'seller_nigar', 'email' => 'seller.nigar@secondbook.test'],
            ['first_name' => 'Rauf', 'last_name' => 'Karimov', 'username' => 'seller_rauf', 'email' => 'seller.rauf@secondbook.test'],
            ['first_name' => 'Aysel', 'last_name' => 'Quliyeva', 'username' => 'seller_aysel', 'email' => 'seller.aysel@secondbook.test'],
            ['first_name' => 'Murad', 'last_name' => 'Aliyev', 'username' => 'seller_murad', 'email' => 'seller.murad@secondbook.test'],
        ];

        foreach ($categoryNames as $name) {
            Category::updateOrCreate(
                ['name' => $name],
                [
                    'slug' => Str::slug($name),
                    'description' => $name . ' books collection.',
                    'status' => 1,
                ]
            );
        }

        foreach ($authorNames as $name) {
            Author::updateOrCreate(
                ['name' => $name],
                [
                    'bio' => $name . ' is a featured author in SecondBook.',
                    'status' => 1,
                ]
            );
        }

        foreach ($publisherRows as $publisher) {
            Publisher::updateOrCreate(
                ['name' => $publisher['name']],
                [
                    'country' => $publisher['country'],
                    'website' => $publisher['website'],
                    'description' => $publisher['name'] . ' publishing house.',
                    'status' => 1,
                ]
            );
        }

        foreach ($sellerRows as $seller) {
            $fullName = $seller['first_name'] . ' ' . $seller['last_name'];

            User::updateOrCreate(
                ['email' => $seller['email']],
                [
                    'name' => $fullName,
                    'first_name' => $seller['first_name'],
                    'last_name' => $seller['last_name'],
                    'username' => $seller['username'],
                    'role' => 'user',
                    'password' => Hash::make('Password@123'),
                    'profile_visibility' => true,
                    'receive_email_notifications' => true,
                    'receive_order_updates' => true,
                    'receive_promotional_emails' => false,
                ]
            );
        }

        $categories = Category::orderBy('id')->take(5)->get();
        $authors = Author::orderBy('id')->take(5)->get();
        $publishers = Publisher::orderBy('id')->take(5)->get();
        $sellers = User::where('email', 'like', 'seller.%@secondbook.test')->orderBy('id')->take(5)->get();

        $bookRows = [
            ['title' => '1984', 'isbn' => '9780451524935', 'price' => 12.50, 'condition' => 'good', 'status' => 'approved'],
            ['title' => 'Pride and Prejudice', 'isbn' => '9780141439518', 'price' => 14.99, 'condition' => 'like_new', 'status' => 'approved'],
            ['title' => 'Sapiens', 'isbn' => '9780062316097', 'price' => 18.90, 'condition' => 'new', 'status' => 'approved'],
            ['title' => 'Murder on the Orient Express', 'isbn' => '9780062693662', 'price' => 11.75, 'condition' => 'fair', 'status' => 'pending'],
            ['title' => 'Clean Code', 'isbn' => '9780132350884', 'price' => 21.00, 'condition' => 'good', 'status' => 'approved'],
        ];

        foreach ($bookRows as $index => $row) {
            if (!isset($categories[$index], $authors[$index], $publishers[$index], $sellers[$index])) {
                continue;
            }

            Book::updateOrCreate(
                ['isbn' => $row['isbn']],
                [
                    'title' => $row['title'],
                    'category_id' => $categories[$index]->id,
                    'author_id' => $authors[$index]->id,
                    'publisher_id' => $publishers[$index]->id,
                    'seller_id' => $sellers[$index]->id,
                    'description' => $row['title'] . ' sample book for admin management.',
                    'publication_year' => 2000 + $index,
                    'pages' => 220 + ($index * 30),
                    'language' => 'English',
                    'price' => $row['price'],
                    'stock' => 5 + $index,
                    'condition' => $row['condition'],
                    'status' => $row['status'],
                ]
            );
        }
    }
}
