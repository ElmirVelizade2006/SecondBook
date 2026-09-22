<?php

namespace Database\Seeders;

use App\Models\Author;
use App\Models\Book;
use App\Models\Category;
use App\Models\Publisher;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class SellerBooksSeeder extends Seeder
{
    public function run(): void
    {
        /*
        |--------------------------------------------------------------------------
        | Find Seller
        |--------------------------------------------------------------------------
        */

        $seller = User::where('role', 'seller')->first();

        if (!$seller) {
            $this->command->error('No seller user found.');
            return;
        }

        /*
        |--------------------------------------------------------------------------
        | Delete Old Test Books
        |--------------------------------------------------------------------------
        */

        $oldTestBooks = Book::where('seller_id', $seller->id)
            ->where(
                'description',
                'Test book created for Seller Panel testing.'
            )
            ->get();

        foreach ($oldTestBooks as $oldBook) {

            if ($oldBook->cover) {
                Storage::disk('public')->delete($oldBook->cover);
            }

            $oldBook->delete();
        }

        /*
        |--------------------------------------------------------------------------
        | Get Related Data
        |--------------------------------------------------------------------------
        */

        $category = Category::first();
        $author = Author::first();
        $publisher = Publisher::first();

        if (!$category || !$author || !$publisher) {

            $this->command->error(
                'Please make sure you have at least one category, author and publisher.'
            );

            return;
        }

        /*
        |--------------------------------------------------------------------------
        | Test Books
        |--------------------------------------------------------------------------
        */

        $books = [

            [
                'The Great Gatsby',
                '9780743273565',
                12.50,
                3,
                'good',
                'approved'
            ],

            [
                'Harry Potter',
                '9780747532699',
                18.00,
                5,
                'like_new',
                'approved'
            ],

            [
                'Atomic Habits',
                '9780735211292',
                15.00,
                4,
                'new',
                'pending'
            ],

            [
                'The Alchemist',
                '9780062315007',
                10.00,
                2,
                'good',
                'pending'
            ],

            [
                '1984',
                '9780451524935',
                14.00,
                6,
                'fair',
                'rejected'
            ],

            [
                'Pride and Prejudice',
                '9780141439518',
                11.00,
                3,
                'good',
                'approved'
            ],

            [
                'The Hobbit',
                '9780547928227',
                16.50,
                4,
                'like_new',
                'approved'
            ],

            [
                'Clean Code',
                '9780132350884',
                25.00,
                2,
                'good',
                'pending'
            ],

            [
                'The Little Prince',
                '9780156012195',
                9.50,
                7,
                'new',
                'approved'
            ],

            [
                'Rich Dad Poor Dad',
                '9781612680194',
                13.00,
                5,
                'good',
                'approved'
            ],

            [
                'Think and Grow Rich',
                '9781585424337',
                12.00,
                4,
                'fair',
                'pending'
            ],

            [
                'The Psychology of Money',
                '9780857197689',
                17.00,
                3,
                'like_new',
                'approved'
            ],

            [
                'Deep Work',
                '9781455586691',
                16.00,
                4,
                'good',
                'pending'
            ],

            [
                'The 7 Habits of Highly Effective People',
                '9781982137274',
                19.00,
                2,
                'new',
                'approved'
            ],

            [
                'Dune',
                '9780441172719',
                20.00,
                3,
                'good',
                'approved'
            ],

            [
                'The Book Thief',
                '9780375842207',
                14.50,
                5,
                'like_new',
                'pending'
            ],

            [
                'Sapiens',
                '9780062316097',
                21.00,
                2,
                'good',
                'approved'
            ],

            [
                'The Lord of the Rings',
                '9780544003415',
                22.00,
                3,
                'fair',
                'rejected'
            ],

            [
                'The Catcher in the Rye',
                '9780316769488',
                13.50,
                4,
                'good',
                'approved'
            ],

            [
                'To Kill a Mockingbird',
                '9780061120084',
                12.00,
                5,
                'like_new',
                'pending'
            ],

        ];

        /*
        |--------------------------------------------------------------------------
        | Create Books + Covers
        |--------------------------------------------------------------------------
        */

        foreach ($books as $index => $book) {

            $bookNumber = $index + 1;

            $safeTitle = htmlspecialchars(
                $book[0],
                ENT_QUOTES,
                'UTF-8'
            );

            /*
            |--------------------------------------------------------------------------
            | Create SVG Cover
            |--------------------------------------------------------------------------
            */

            $svg = <<<SVG
<svg xmlns="http://www.w3.org/2000/svg"
     width="600"
     height="850"
     viewBox="0 0 600 850">

    <rect
        width="600"
        height="850"
        fill="#8B5E3C"
    />

    <rect
        x="35"
        y="35"
        width="530"
        height="780"
        rx="18"
        fill="#ffffff"
    />

    <rect
        x="65"
        y="65"
        width="470"
        height="8"
        rx="4"
        fill="#8B5E3C"
    />

    <text
        x="300"
        y="300"
        text-anchor="middle"
        font-family="Arial, sans-serif"
        font-size="38"
        font-weight="700"
        fill="#222222"
    >
        {$safeTitle}
    </text>

    <text
        x="300"
        y="390"
        text-anchor="middle"
        font-family="Arial, sans-serif"
        font-size="20"
        fill="#777777"
    >
        SecondBook
    </text>

    <text
        x="300"
        y="700"
        text-anchor="middle"
        font-family="Arial, sans-serif"
        font-size="18"
        fill="#999999"
    >
        Test Book #{$bookNumber}
    </text>

    <rect
        x="65"
        y="740"
        width="470"
        height="8"
        rx="4"
        fill="#8B5E3C"
    />

</svg>
SVG;

            $coverPath = 'books/test-book-' . $bookNumber . '.svg';

            Storage::disk('public')->put(
                $coverPath,
                $svg
            );

            /*
            |--------------------------------------------------------------------------
            | Create Book
            |--------------------------------------------------------------------------
            */

            Book::create([

                'seller_id' => $seller->id,

                'title' => $book[0],

                'isbn' => $book[1],

                'category_id' => $category->id,

                'author_id' => $author->id,

                'publisher_id' => $publisher->id,

                'description' =>
                    'Test book created for Seller Panel testing.',

                'cover' => $coverPath,

                'publication_year' => rand(2000, 2025),

                'pages' => rand(150, 500),

                'language' => 'English',

                'price' => $book[2],

                'stock' => $book[3],

                'condition' => $book[4],

                'status' => $book[5],

            ]);
        }

        /*
        |--------------------------------------------------------------------------
        | Success Message
        |--------------------------------------------------------------------------
        */

        $this->command->info(
            '20 seller test books with covers created successfully.'
        );
    }
}