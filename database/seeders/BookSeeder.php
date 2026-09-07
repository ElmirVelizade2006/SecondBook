<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Author;
use App\Models\Publisher;
use App\Models\Book;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Fiction',
                'slug' => 'fiction',
                'description' => 'Fiction books and novels.',
                'status' => 1,
            ],
            [
                'name' => 'Non-Fiction',
                'slug' => 'non-fiction',
                'description' => 'Fact-based books and essays.',
                'status' => 1,
            ],
            [
                'name' => 'Science',
                'slug' => 'science',
                'description' => 'Science and discovery books.',
                'status' => 1,
            ],
            [
                'name' => 'History',
                'slug' => 'history',
                'description' => 'Historical books and biographies.',
                'status' => 1,
            ],
            [
                'name' => 'Biography',
                'slug' => 'biography',
                'description' => 'Life stories and memoirs.',
                'status' => 1,
            ],
            [
                'name' => 'Children',
                'slug' => 'children',
                'description' => 'Books for young readers.',
                'status' => 1,
            ],
            [
                'name' => 'Technology',
                'slug' => 'technology',
                'description' => 'Programming and technology books.',
                'status' => 1,
            ],
            [
                'name' => 'Romance',
                'slug' => 'romance',
                'description' => 'Romantic stories and novels.',
                'status' => 1,
            ],
            [
                'name' => 'Fantasy',
                'slug' => 'fantasy',
                'description' => 'Fantasy and magical worlds.',
                'status' => 1,
            ],
            [
                'name' => 'Psychology',
                'slug' => 'psychology',
                'description' => 'Mind, behavior, and human psychology books.',
                'status' => 1,
            ],
        ];

        foreach ($categories as $categoryData) {
            Category::firstOrCreate(
                ['name' => $categoryData['name']],
                [
                    'slug' => $categoryData['slug'],
                    'description' => $categoryData['description'],
                    'status' => $categoryData['status'],
                ]
            );
        }

        $authors = [
            ['name' => 'Jane Austen', 'bio' => 'English novelist known for romance and social satire.', 'status' => 1],
            ['name' => 'George Orwell', 'bio' => 'British writer famous for political fiction.', 'status' => 1],
            ['name' => 'Haruki Murakami', 'bio' => 'Japanese author known for surreal and introspective fiction.', 'status' => 1],
            ['name' => 'Agatha Christie', 'bio' => 'Queen of crime fiction and mystery novels.', 'status' => 1],
            ['name' => 'Ismail Kadare', 'bio' => 'Albanian writer known for literary and historical works.', 'status' => 1],
            ['name' => 'Yuval Noah Harari', 'bio' => 'Historian and author of popular non-fiction.', 'status' => 1],
            ['name' => 'Paulo Coelho', 'bio' => 'Brazilian novelist known for philosophical fiction.', 'status' => 1],
            ['name' => 'Malala Yousafzai', 'bio' => 'Advocate and author of inspirational memoirs.', 'status' => 1],
            ['name' => 'Stephen King', 'bio' => 'Best-selling author of horror and suspense fiction.', 'status' => 1],
            ['name' => 'Erich Fromm', 'bio' => 'Humanistic psychoanalyst and social philosopher.', 'status' => 1],
        ];

        foreach ($authors as $authorData) {
            Author::firstOrCreate(
                ['name' => $authorData['name']],
                [
                    'bio' => $authorData['bio'],
                    'status' => $authorData['status'],
                ]
            );
        }

        $publishers = [
            ['name' => 'Penguin Books', 'country' => 'UK', 'website' => 'https://www.penguin.com', 'description' => 'Global publisher of literary fiction and non-fiction.', 'status' => 1],
            ['name' => 'HarperCollins', 'country' => 'USA', 'website' => 'https://www.harpercollins.com', 'description' => 'Major publishing house with broad genre coverage.', 'status' => 1],
            ['name' => 'Oxford University Press', 'country' => 'UK', 'website' => 'https://global.oup.com', 'description' => 'Renowned academic and educational publisher.', 'status' => 1],
            ['name' => 'Scribner', 'country' => 'USA', 'website' => 'https://www.simonandschuster.com', 'description' => 'Publisher of bestselling fiction and memoirs.', 'status' => 1],
            ['name' => 'Vintage', 'country' => 'USA', 'website' => 'https://www.vintagebooks.com', 'description' => 'Independent-minded publisher of acclaimed books.', 'status' => 1],
            ['name' => 'Macmillan', 'country' => 'UK', 'website' => 'https://us.macmillan.com', 'description' => 'International publisher with strong fiction lists.', 'status' => 1],
            ['name' => 'Hachette Book Group', 'country' => 'USA', 'website' => 'https://www.hachettebookgroup.com', 'description' => 'Large publisher of trade and mass-market books.', 'status' => 1],
            ['name' => 'Springer', 'country' => 'Germany', 'website' => 'https://www.springer.com', 'description' => 'Leading science and academic publishing house.', 'status' => 1],
            ['name' => 'Bloomsbury', 'country' => 'UK', 'website' => 'https://www.bloomsbury.com', 'description' => 'Publisher of fiction, nonfiction, and children’s books.', 'status' => 1],
            ['name' => 'Pearson', 'country' => 'UK', 'website' => 'https://www.pearson.com', 'description' => 'Publisher focused on education and learning content.', 'status' => 1],
        ];

        foreach ($publishers as $publisherData) {
            Publisher::firstOrCreate(
                ['name' => $publisherData['name']],
                [
                    'country' => $publisherData['country'],
                    'website' => $publisherData['website'],
                    'description' => $publisherData['description'],
                    'status' => $publisherData['status'],
                ]
            );
        }

        $books = [
            [
                'title' => 'Pride and Prejudice',
                'isbn' => '9780141439518',
                'category' => 'Fiction',
                'author' => 'Jane Austen',
                'publisher' => 'Penguin Books',
                'description' => 'A classic novel of manners, love, and society.',
                'publication_year' => 1813,
                'pages' => 432,
                'language' => 'English',
                'price' => 14.99,
                'stock' => 8,
                'condition' => 'good',
                'status' => 'approved',
            ],
            [
                'title' => '1984',
                'isbn' => '9780451524935',
                'category' => 'Non-Fiction',
                'author' => 'George Orwell',
                'publisher' => 'HarperCollins',
                'description' => 'A dystopian tale about surveillance and control.',
                'publication_year' => 1949,
                'pages' => 328,
                'language' => 'English',
                'price' => 12.50,
                'stock' => 10,
                'condition' => 'like_new',
                'status' => 'approved',
            ],
            [
                'title' => 'Kafka on the Shore',
                'isbn' => '9781400079278',
                'category' => 'Fantasy',
                'author' => 'Haruki Murakami',
                'publisher' => 'Vintage',
                'description' => 'A surreal journey blending fate, memory, and magic realism.',
                'publication_year' => 2002,
                'pages' => 505,
                'language' => 'English',
                'price' => 16.00,
                'stock' => 6,
                'condition' => 'good',
                'status' => 'pending',
            ],
            [
                'title' => 'Murder on the Orient Express',
                'isbn' => '9780062693662',
                'category' => 'Fiction',
                'author' => 'Agatha Christie',
                'publisher' => 'Scribner',
                'description' => 'A famous Hercule Poirot mystery on a luxury train.',
                'publication_year' => 1934,
                'pages' => 288,
                'language' => 'English',
                'price' => 11.75,
                'stock' => 9,
                'condition' => 'fair',
                'status' => 'approved',
            ],
            [
                'title' => 'Chronicle in Stone',
                'isbn' => '9781611450095',
                'category' => 'History',
                'author' => 'Ismail Kadare',
                'publisher' => 'Bloomsbury',
                'description' => 'A wartime coming-of-age story set in Albania.',
                'publication_year' => 1971,
                'pages' => 272,
                'language' => 'English',
                'price' => 13.20,
                'stock' => 5,
                'condition' => 'good',
                'status' => 'approved',
            ],
            [
                'title' => 'Sapiens',
                'isbn' => '9780062316097',
                'category' => 'Science',
                'author' => 'Yuval Noah Harari',
                'publisher' => 'HarperCollins',
                'description' => 'A brief history of humankind from ancient times to now.',
                'publication_year' => 2011,
                'pages' => 464,
                'language' => 'English',
                'price' => 18.90,
                'stock' => 12,
                'condition' => 'new',
                'status' => 'approved',
            ],
            [
                'title' => 'The Alchemist',
                'isbn' => '9780061122415',
                'category' => 'Romance',
                'author' => 'Paulo Coelho',
                'publisher' => 'HarperCollins',
                'description' => 'A symbolic novel about destiny and personal legend.',
                'publication_year' => 1988,
                'pages' => 208,
                'language' => 'English',
                'price' => 10.40,
                'stock' => 14,
                'condition' => 'like_new',
                'status' => 'approved',
            ],
            [
                'title' => 'I Am Malala',
                'isbn' => '9780316322423',
                'category' => 'Biography',
                'author' => 'Malala Yousafzai',
                'publisher' => 'Hachette Book Group',
                'description' => 'Memoir of courage, education, and activism.',
                'publication_year' => 2013,
                'pages' => 336,
                'language' => 'English',
                'price' => 15.30,
                'stock' => 7,
                'condition' => 'good',
                'status' => 'pending',
            ],
            [
                'title' => 'The Shining',
                'isbn' => '9780307743657',
                'category' => 'Fiction',
                'author' => 'Stephen King',
                'publisher' => 'Scribner',
                'description' => 'A psychological horror novel set in an isolated hotel.',
                'publication_year' => 1977,
                'pages' => 688,
                'language' => 'English',
                'price' => 17.10,
                'stock' => 4,
                'condition' => 'fair',
                'status' => 'approved',
            ],
            [
                'title' => 'The Art of Loving',
                'isbn' => '9780061129735',
                'category' => 'Psychology',
                'author' => 'Erich Fromm',
                'publisher' => 'Penguin Books',
                'description' => 'A classic exploration of love as an art and practice.',
                'publication_year' => 1956,
                'pages' => 192,
                'language' => 'English',
                'price' => 9.80,
                'stock' => 11,
                'condition' => 'new',
                'status' => 'approved',
            ],
        ];

        foreach ($books as $bookData) {
            $category = Category::where('name', $bookData['category'])->first();
            $author = Author::where('name', $bookData['author'])->first();
            $publisher = Publisher::where('name', $bookData['publisher'])->first();

            if (!$category || !$author || !$publisher) {
                continue;
            }

            Book::updateOrCreate(
                ['title' => $bookData['title']],
                [
                    'isbn' => $bookData['isbn'],
                    'category_id' => $category->id,
                    'author_id' => $author->id,
                    'publisher_id' => $publisher->id,
                    'seller_id' => null,
                    'description' => $bookData['description'],
                    'cover' => null,
                    'publication_year' => $bookData['publication_year'],
                    'pages' => $bookData['pages'],
                    'language' => $bookData['language'],
                    'price' => $bookData['price'],
                    'stock' => $bookData['stock'],
                    'condition' => $bookData['condition'],
                    'status' => $bookData['status'],
                ]
            );
        }
    }
}
