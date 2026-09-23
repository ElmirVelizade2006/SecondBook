<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class BlogSeeder extends Seeder
{
    public function run(): void
    {
        $adminId = DB::table('users')
            ->where('email', 'admin@secondbook.com')
            ->value('id');

        $blogs = [
            [
                'title' => 'Why Reading Books Still Matters',
                'excerpt' => 'Discover how regular reading can become a valuable part of everyday life.',
                'content' => 'Reading remains one of the simplest ways to explore new ideas, discover different perspectives, and develop a lifelong learning habit. Whether you prefer fiction, biographies, history, or technology books, every book can offer something valuable.',
                'image' => 'https://images.unsplash.com/photo-1495446815901-a7297e633e8d?auto=format&fit=crop&w=1200&q=85',
            ],
            [
                'title' => 'How to Build a Personal Library',
                'excerpt' => 'Practical ideas for creating a meaningful and organized book collection.',
                'content' => 'Building a personal library does not require hundreds of books. Start with subjects and genres you genuinely enjoy. Organize your books in a way that makes them easy to find and regularly revisit the titles that matter most to you.',
                'image' => 'https://images.unsplash.com/photo-1521587760476-6c12a4b040da?auto=format&fit=crop&w=1200&q=85',
            ],
            [
                'title' => 'The Benefits of Buying Pre-Owned Books',
                'excerpt' => 'Learn why second-hand books can be a great choice for readers.',
                'content' => 'Pre-owned books can make reading more affordable while also giving existing books a second life. Buying used books can help readers discover titles they might otherwise skip and allows books to continue circulating between different readers.',
                'image' => 'https://images.unsplash.com/photo-1526243741027-444d633d7365?auto=format&fit=crop&w=1200&q=85',
            ],
            [
                'title' => 'Tips for New Book Sellers',
                'excerpt' => 'Simple steps to create better listings and attract more customers.',
                'content' => 'Successful book listings should contain clear titles, accurate descriptions, realistic condition information, and attractive photographs. Keeping stock information accurate and processing orders quickly can also create a better customer experience.',
                'image' => 'https://images.unsplash.com/photo-1524578271613-d550eacf6090?auto=format&fit=crop&w=1200&q=85',
            ],
            [
                'title' => 'Choosing Your Next Book',
                'excerpt' => 'A few simple ways to decide what to read next.',
                'content' => 'When you are unsure what to read next, consider your current interests, explore a new genre, revisit an author you enjoyed, or ask other readers for recommendations. Your next favorite book might be very different from your usual choices.',
                'image' => 'https://images.unsplash.com/photo-1519682337058-a94d519337bc?auto=format&fit=crop&w=1200&q=85',
            ],
        ];

        foreach ($blogs as $blog) {
            DB::table('blogs')->updateOrInsert(
                ['slug' => Str::slug($blog['title'])],
                [
                    'title' => $blog['title'],
                    'slug' => Str::slug($blog['title']),
                    'excerpt' => $blog['excerpt'],
                    'content' => $blog['content'],
                    'image' => $blog['image'],
                    'author_id' => $adminId,
                    'status' => 'published',
                    'published_at' => now()->subDays(rand(1, 30)),
                    'updated_at' => now(),
                    'created_at' => now(),
                ]
            );
        }
    }
}