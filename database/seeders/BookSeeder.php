<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Author;
use App\Models\Book;
use App\Models\Category;
use App\Models\Publisher;

class BookSeeder extends Seeder
{
    public function run(): void
    {
        /*
        |--------------------------------------------------------------------------
        | Authors
        |--------------------------------------------------------------------------
        */

        $authors = [
            'Jane Austen',
            'George Orwell',
            'Haruki Murakami',
            'Agatha Christie',
            'Elchin Safarli',
            'Ismail Kadare',
            'Yuval Noah Harari',
            'Paulo Coelho',
            'Malala Yousafzai',
            'Stephen King',
            'Erich Fromm',
            'Leo Tolstoy',
            'Fyodor Dostoevsky',
            'Gabriel Garcia Marquez',
            'Franz Kafka',
            'J.K. Rowling',
            'J.R.R. Tolkien',
            'Antoine de Saint-Exupery',
            'Daniel Kahneman',
            'James Clear',
            'Stephen Hawking',
            'Walter Isaacson',
            'Robert C. Martin',
            'Brian Kernighan',
            'Martin Fowler',
            'Morgan Housel',
            'Markus Zusak',
            'Umberto Eco',
            'Matt Haig',
            'Alex Michaelides',
            'Neil Gaiman',
        ];

        foreach ($authors as $author) {
            Author::firstOrCreate([
                'name' => $author,
            ]);
        }

        /*
        |--------------------------------------------------------------------------
        | Publishers
        |--------------------------------------------------------------------------
        */

        $publishers = [
            'Penguin Books',
            'HarperCollins',
            'Oxford University Press',
            'Scribner',
            'Vintage',
            'Macmillan',
            'Hachette Book Group',
            'Springer',
            'Bloomsbury',
            'Pearson',
        ];

        foreach ($publishers as $publisher) {
            Publisher::firstOrCreate([
                'name' => $publisher,
            ]);
        }

        /*
        |--------------------------------------------------------------------------
        | Books
        |--------------------------------------------------------------------------
        */

        $books = [

            // Jane Austen
            [
                'title' => 'Pride and Prejudice',
                'author' => 'Jane Austen',
                'category' => 'Classic Literature',
                'publisher' => 'Penguin Books',
                'isbn' => '9780141439518',
                'description' => 'A classic novel about love, family, society and personal relationships.',
            ],
            [
                'title' => 'Emma',
                'author' => 'Jane Austen',
                'category' => 'Romance',
                'publisher' => 'Penguin Books',
                'isbn' => '9780141439587',
                'description' => 'A classic story about friendship, relationships and matchmaking.',
            ],

            // George Orwell
            [
                'title' => '1984',
                'author' => 'George Orwell',
                'category' => 'Fiction',
                'publisher' => 'HarperCollins',
                'isbn' => '9780451524935',
                'description' => 'A dystopian story about surveillance, control and freedom.',
            ],
            [
                'title' => 'Animal Farm',
                'author' => 'George Orwell',
                'category' => 'Drama',
                'publisher' => 'Penguin Books',
                'isbn' => '9780141036137',
                'description' => 'An allegorical story about power, society and leadership.',
            ],

            // Haruki Murakami
            [
                'title' => 'Norwegian Wood',
                'author' => 'Haruki Murakami',
                'category' => 'Romance',
                'publisher' => 'Vintage',
                'isbn' => '9780375704024',
                'description' => 'A reflective story about love, memory and growing up.',
            ],
            [
                'title' => 'Kafka on the Shore',
                'author' => 'Haruki Murakami',
                'category' => 'Fantasy',
                'publisher' => 'Vintage',
                'isbn' => '9781400079278',
                'description' => 'A mysterious novel combining dreams, reality and extraordinary events.',
            ],

            // Agatha Christie
            [
                'title' => 'Murder on the Orient Express',
                'author' => 'Agatha Christie',
                'category' => 'Mystery',
                'publisher' => 'Scribner',
                'isbn' => '9780062693662',
                'description' => 'A famous detective mystery involving a murder aboard a luxury train.',
            ],
            [
                'title' => 'And Then There Were None',
                'author' => 'Agatha Christie',
                'category' => 'Thriller',
                'publisher' => 'HarperCollins',
                'isbn' => '9780062073488',
                'description' => 'A classic mystery involving a group of strangers on an island.',
            ],

            // Elchin Safarli
            [
                'title' => 'The Sweet Salt of the Bosphorus',
                'author' => 'Elchin Safarli',
                'category' => 'Romance',
                'publisher' => 'Vintage',
                'isbn' => '9780000000101',
                'description' => 'A literary story about love, memories, Istanbul and human relationships.',
            ],
            [
                'title' => 'There Without Back',
                'author' => 'Elchin Safarli',
                'category' => 'Fiction',
                'publisher' => 'Penguin Books',
                'isbn' => '9780000000102',
                'description' => 'A reflective literary work exploring life, emotions and personal memories.',
            ],

            // Ismail Kadare
            [
                'title' => 'The General of the Dead Army',
                'author' => 'Ismail Kadare',
                'category' => 'Historical Fiction',
                'publisher' => 'Vintage',
                'isbn' => '9780802143181',
                'description' => 'A literary novel exploring war, memory and history.',
            ],
            [
                'title' => 'Chronicle in Stone',
                'author' => 'Ismail Kadare',
                'category' => 'History',
                'publisher' => 'Bloomsbury',
                'isbn' => '9781611450095',
                'description' => 'A literary story reflecting childhood, war and historical change.',
            ],

            // Yuval Noah Harari
            [
                'title' => 'Sapiens',
                'author' => 'Yuval Noah Harari',
                'category' => 'Science',
                'publisher' => 'HarperCollins',
                'isbn' => '9780062316097',
                'description' => 'An overview of human history and the development of civilization.',
            ],
            [
                'title' => 'Homo Deus',
                'author' => 'Yuval Noah Harari',
                'category' => 'Philosophy',
                'publisher' => 'HarperCollins',
                'isbn' => '9780062464316',
                'description' => 'A discussion of humanity, technology and the future.',
            ],

            // Paulo Coelho
            [
                'title' => 'The Alchemist',
                'author' => 'Paulo Coelho',
                'category' => 'Fiction',
                'publisher' => 'HarperCollins',
                'isbn' => '9780061122415',
                'description' => 'A philosophical journey about dreams, purpose and following your goals.',
            ],
            [
                'title' => 'Veronika Decides to Die',
                'author' => 'Paulo Coelho',
                'category' => 'Philosophy',
                'publisher' => 'HarperCollins',
                'isbn' => '9780061124267',
                'description' => 'A philosophical story exploring life, identity and meaning.',
            ],

            // Malala Yousafzai
            [
                'title' => 'I Am Malala',
                'author' => 'Malala Yousafzai',
                'category' => 'Biography',
                'publisher' => 'Hachette Book Group',
                'isbn' => '9780316322423',
                'description' => 'A memoir about education, courage and personal experiences.',
            ],
            [
                'title' => 'We Are Displaced',
                'author' => 'Malala Yousafzai',
                'category' => 'Autobiography',
                'publisher' => 'Hachette Book Group',
                'isbn' => '9780316523639',
                'description' => 'Personal stories about displacement, courage and identity.',
            ],

            // Stephen King
            [
                'title' => 'The Shining',
                'author' => 'Stephen King',
                'category' => 'Horror',
                'publisher' => 'Scribner',
                'isbn' => '9780307743657',
                'description' => 'A psychological horror story set in an isolated hotel.',
            ],
            [
                'title' => 'It',
                'author' => 'Stephen King',
                'category' => 'Horror',
                'publisher' => 'Scribner',
                'isbn' => '9781501142970',
                'description' => 'A dark story about friendship, fear and an ancient mysterious creature.',
            ],

            // Erich Fromm
            [
                'title' => 'The Art of Loving',
                'author' => 'Erich Fromm',
                'category' => 'Psychology',
                'publisher' => 'Penguin Books',
                'isbn' => '9780061129735',
                'description' => 'A psychological exploration of love, relationships and human connection.',
            ],
            [
                'title' => 'Escape from Freedom',
                'author' => 'Erich Fromm',
                'category' => 'Psychology',
                'publisher' => 'Penguin Books',
                'isbn' => '9780801200206',
                'description' => 'A study of freedom, society and human psychology.',
            ],

            // Leo Tolstoy
            [
                'title' => 'War and Peace',
                'author' => 'Leo Tolstoy',
                'category' => 'Classic Literature',
                'publisher' => 'Penguin Books',
                'isbn' => '9780140447934',
                'description' => 'A monumental classic exploring war, society, family and human life.',
            ],
            [
                'title' => 'Anna Karenina',
                'author' => 'Leo Tolstoy',
                'category' => 'Romance',
                'publisher' => 'Penguin Books',
                'isbn' => '9780143035008',
                'description' => 'A classic novel about love, marriage, society and personal choices.',
            ],

            // Fyodor Dostoevsky
            [
                'title' => 'Crime and Punishment',
                'author' => 'Fyodor Dostoevsky',
                'category' => 'Classic Literature',
                'publisher' => 'Penguin Books',
                'isbn' => '9780143058144',
                'description' => 'A psychological novel exploring morality, guilt and redemption.',
            ],
            [
                'title' => 'The Brothers Karamazov',
                'author' => 'Fyodor Dostoevsky',
                'category' => 'Philosophy',
                'publisher' => 'Penguin Books',
                'isbn' => '9780374528379',
                'description' => 'A philosophical and psychological novel about family, faith and morality.',
            ],

            // Gabriel Garcia Marquez
            [
                'title' => 'One Hundred Years of Solitude',
                'author' => 'Gabriel Garcia Marquez',
                'category' => 'Fantasy',
                'publisher' => 'Vintage',
                'isbn' => '9780060883287',
                'description' => 'A magical realist novel following generations of a family.',
            ],
            [
                'title' => 'Love in the Time of Cholera',
                'author' => 'Gabriel Garcia Marquez',
                'category' => 'Romance',
                'publisher' => 'Vintage',
                'isbn' => '9780307389732',
                'description' => 'A literary love story spanning many years.',
            ],

            // Franz Kafka
            [
                'title' => 'The Metamorphosis',
                'author' => 'Franz Kafka',
                'category' => 'Fiction',
                'publisher' => 'Penguin Books',
                'isbn' => '9780142437230',
                'description' => 'A surreal literary story exploring identity, family and isolation.',
            ],
            [
                'title' => 'The Trial',
                'author' => 'Franz Kafka',
                'category' => 'Drama',
                'publisher' => 'Penguin Books',
                'isbn' => '9780805209990',
                'description' => 'A surreal novel about bureaucracy, justice and uncertainty.',
            ],

            // J.K. Rowling
            [
                'title' => 'Harry Potter and the Philosopher’s Stone',
                'author' => 'J.K. Rowling',
                'category' => 'Fantasy',
                'publisher' => 'Bloomsbury',
                'isbn' => '9780747532699',
                'description' => 'A young wizard begins his magical education at Hogwarts.',
            ],
            [
                'title' => 'Harry Potter and the Chamber of Secrets',
                'author' => 'J.K. Rowling',
                'category' => 'Young Adult',
                'publisher' => 'Bloomsbury',
                'isbn' => '9780747549604',
                'description' => 'Harry returns to Hogwarts and faces a mysterious hidden danger.',
            ],

            // J.R.R. Tolkien
            [
                'title' => 'The Hobbit',
                'author' => 'J.R.R. Tolkien',
                'category' => 'Adventure',
                'publisher' => 'HarperCollins',
                'isbn' => '9780547928227',
                'description' => 'A fantasy adventure following Bilbo Baggins on an unexpected journey.',
            ],
            [
                'title' => 'The Lord of the Rings',
                'author' => 'J.R.R. Tolkien',
                'category' => 'Fantasy',
                'publisher' => 'HarperCollins',
                'isbn' => '9780261102385',
                'description' => 'An epic fantasy adventure about friendship, courage and the struggle against evil.',
            ],

            // Antoine de Saint-Exupery
            [
                'title' => 'The Little Prince',
                'author' => 'Antoine de Saint-Exupery',
                'category' => 'Children',
                'publisher' => 'Penguin Books',
                'isbn' => '9780156012195',
                'description' => 'A philosophical children’s story about friendship and life.',
            ],
            [
                'title' => 'Wind, Sand and Stars',
                'author' => 'Antoine de Saint-Exupery',
                'category' => 'Travel',
                'publisher' => 'Penguin Books',
                'isbn' => '9780156949034',
                'description' => 'A memoir reflecting on aviation, travel and human experience.',
            ],

            // Daniel Kahneman
            [
                'title' => 'Thinking, Fast and Slow',
                'author' => 'Daniel Kahneman',
                'category' => 'Psychology',
                'publisher' => 'Penguin Books',
                'isbn' => '9780374533557',
                'description' => 'An exploration of human thinking, judgment and decision-making.',
            ],
            [
                'title' => 'Noise',
                'author' => 'Daniel Kahneman',
                'category' => 'Business',
                'publisher' => 'HarperCollins',
                'isbn' => '9780008308990',
                'description' => 'An exploration of variability in human judgments and decisions.',
            ],

            // James Clear
            [
                'title' => 'Atomic Habits',
                'author' => 'James Clear',
                'category' => 'Self-Help',
                'publisher' => 'Penguin Books',
                'isbn' => '9780735211292',
                'description' => 'A practical guide to building better habits.',
            ],
            [
                'title' => 'Atomic Habits Workbook',
                'author' => 'James Clear',
                'category' => 'Education',
                'publisher' => 'Penguin Books',
                'isbn' => '9780000000202',
                'description' => 'A practical workbook focused on personal improvement and habit building.',
            ],

            // Stephen Hawking
            [
                'title' => 'A Brief History of Time',
                'author' => 'Stephen Hawking',
                'category' => 'Science',
                'publisher' => 'Oxford University Press',
                'isbn' => '9780553380163',
                'description' => 'An accessible introduction to major ideas about the universe.',
            ],
            [
                'title' => 'The Universe in a Nutshell',
                'author' => 'Stephen Hawking',
                'category' => 'Science',
                'publisher' => 'Penguin Books',
                'isbn' => '9780553802023',
                'description' => 'An illustrated exploration of modern ideas in physics and cosmology.',
            ],

            // Walter Isaacson
            [
                'title' => 'Steve Jobs',
                'author' => 'Walter Isaacson',
                'category' => 'Biography',
                'publisher' => 'Scribner',
                'isbn' => '9781451648539',
                'description' => 'A biography exploring the life, work and innovation of Steve Jobs.',
            ],
            [
                'title' => 'Leonardo da Vinci',
                'author' => 'Walter Isaacson',
                'category' => 'Biography',
                'publisher' => 'Simon & Schuster',
                'isbn' => '9781501139154',
                'description' => 'A biography of Leonardo da Vinci and his extraordinary achievements.',
            ],

            // Robert C. Martin
            [
                'title' => 'Clean Code',
                'author' => 'Robert C. Martin',
                'category' => 'Programming',
                'publisher' => 'Pearson',
                'isbn' => '9780132350884',
                'description' => 'A practical programming book about writing maintainable software.',
            ],
            [
                'title' => 'The Clean Coder',
                'author' => 'Robert C. Martin',
                'category' => 'Technology',
                'publisher' => 'Pearson',
                'isbn' => '9780137081073',
                'description' => 'A guide to professionalism, discipline and good practices in software development.',
            ],

            // Brian Kernighan
            [
                'title' => 'The C Programming Language',
                'author' => 'Brian Kernighan',
                'category' => 'Programming',
                'publisher' => 'Pearson',
                'isbn' => '9780131103627',
                'description' => 'A classic introduction to the C programming language.',
            ],
            [
                'title' => 'The Practice of Programming',
                'author' => 'Brian Kernighan',
                'category' => 'Technology',
                'publisher' => 'Pearson',
                'isbn' => '9780201615869',
                'description' => 'A practical guide to programming techniques and software development.',
            ],

            // Martin Fowler
            [
                'title' => 'Refactoring',
                'author' => 'Martin Fowler',
                'category' => 'Programming',
                'publisher' => 'Pearson',
                'isbn' => '9780134757599',
                'description' => 'A practical guide to improving the design of existing code.',
            ],
            [
                'title' => 'Patterns of Enterprise Application Architecture',
                'author' => 'Martin Fowler',
                'category' => 'Technology',
                'publisher' => 'Pearson',
                'isbn' => '9780321127426',
                'description' => 'A reference to patterns used in enterprise software architecture.',
            ],

            // Morgan Housel
            [
                'title' => 'The Psychology of Money',
                'author' => 'Morgan Housel',
                'category' => 'Finance',
                'publisher' => 'Hachette Book Group',
                'isbn' => '9780857197689',
                'description' => 'A book about behavior, money and financial decision-making.',
            ],
            [
                'title' => 'Same as Ever',
                'author' => 'Morgan Housel',
                'category' => 'Business',
                'publisher' => 'Hachette Book Group',
                'isbn' => '9780593332702',
                'description' => 'An exploration of timeless behaviors that shape business and life.',
            ],

            // Markus Zusak
            [
                'title' => 'The Book Thief',
                'author' => 'Markus Zusak',
                'category' => 'Historical Fiction',
                'publisher' => 'Macmillan',
                'isbn' => '9780375842207',
                'description' => 'A historical fiction story about a young girl during wartime.',
            ],
            [
                'title' => 'I Am the Messenger',
                'author' => 'Markus Zusak',
                'category' => 'Young Adult',
                'publisher' => 'Macmillan',
                'isbn' => '9780375836671',
                'description' => 'A young adult story about identity, courage and unexpected responsibilities.',
            ],

            // Umberto Eco
            [
                'title' => 'The Name of the Rose',
                'author' => 'Umberto Eco',
                'category' => 'Mystery',
                'publisher' => 'Vintage',
                'isbn' => '9780156001311',
                'description' => 'A historical mystery set in a medieval monastery.',
            ],
            [
                'title' => 'Foucault’s Pendulum',
                'author' => 'Umberto Eco',
                'category' => 'Thriller',
                'publisher' => 'Vintage',
                'isbn' => '9780156032970',
                'description' => 'A literary thriller involving mystery, history and conspiracy.',
            ],

            // Matt Haig
            [
                'title' => 'The Midnight Library',
                'author' => 'Matt Haig',
                'category' => 'Fantasy',
                'publisher' => 'Viking',
                'isbn' => '9780525559474',
                'description' => 'A fantasy story exploring different possibilities of life.',
            ],
            [
                'title' => 'Reasons to Stay Alive',
                'author' => 'Matt Haig',
                'category' => 'Self-Help',
                'publisher' => 'Penguin Books',
                'isbn' => '9780141975769',
                'description' => 'A reflective work about life, personal experiences and finding hope.',
            ],

            // Alex Michaelides
            [
                'title' => 'The Silent Patient',
                'author' => 'Alex Michaelides',
                'category' => 'Thriller',
                'publisher' => 'Macmillan',
                'isbn' => '9781250301697',
                'description' => 'A psychological mystery involving silence, secrets and investigation.',
            ],
            [
                'title' => 'The Maidens',
                'author' => 'Alex Michaelides',
                'category' => 'Mystery',
                'publisher' => 'Macmillan',
                'isbn' => '9781250304452',
                'description' => 'A psychological mystery set around a series of disturbing events.',
            ],

            // Neil Gaiman
            [
                'title' => 'Coraline',
                'author' => 'Neil Gaiman',
                'category' => 'Children',
                'publisher' => 'Bloomsbury',
                'isbn' => '9780380807342',
                'description' => 'A dark fantasy story about courage, family and a mysterious hidden world.',
            ],
            [
                'title' => 'The Ocean at the End of the Lane',
                'author' => 'Neil Gaiman',
                'category' => 'Fantasy',
                'publisher' => 'HarperCollins',
                'isbn' => '9780062459367',
                'description' => 'A mysterious fantasy story involving childhood memories and strange events.',
            ],
        ];

        /*
        |--------------------------------------------------------------------------
        | Create / Update Books
        |--------------------------------------------------------------------------
        */

        foreach ($books as $index => $bookData) {

            $category = Category::where(
                'name',
                $bookData['category']
            )->first();

            $author = Author::where(
                'name',
                $bookData['author']
            )->first();

            $publisher = Publisher::where(
                'name',
                $bookData['publisher']
            )->first();

            $coverUrl =
                'https://loremflickr.com/400/600/book,book-cover?lock='
                . ($index + 1);

            Book::updateOrCreate(
                [
                    'title' => $bookData['title'],
                ],
                [
                    'isbn' => $bookData['isbn'],
                    'category_id' => $category?->id,
                    'author_id' => $author?->id,
                    'publisher_id' => $publisher?->id,
                    'seller_id' => null,
                    'description' => $bookData['description'],
                    'cover' => $coverUrl,
                    'publication_year' => rand(1990, 2025),
                    'pages' => rand(150, 650),
                    'language' => 'English',
                    'price' => rand(8, 50) + 0.99,
                    'stock' => rand(1, 20),
                    'condition' => collect([
                        'new',
                        'like_new',
                        'good',
                        'fair',
                    ])->random(),
                    'status' => 'approved',
                ]
            );
        }
    }
}