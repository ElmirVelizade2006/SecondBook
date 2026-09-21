<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
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
                'description' => 'Imaginative stories, novels, and literary works.',
                'image' => 'https://placehold.co/600x400/8B5E3C/FFFFFF?text=Fiction',
            ],
            [
                'name' => 'Classic Literature',
                'slug' => 'classic-literature',
                'description' => 'Timeless literary works from renowned authors.',
                'image' => 'https://placehold.co/600x400/6B4F3A/FFFFFF?text=Classic+Literature',
            ],
            [
                'name' => 'Mystery',
                'slug' => 'mystery',
                'description' => 'Books involving mysteries, investigations, and hidden secrets.',
                'image' => 'https://placehold.co/600x400/374151/FFFFFF?text=Mystery',
            ],
            [
                'name' => 'Thriller',
                'slug' => 'thriller',
                'description' => 'Fast-paced stories filled with suspense, danger, and tension.',
                'image' => 'https://placehold.co/600x400/1F2937/FFFFFF?text=Thriller',
            ],
            [
                'name' => 'Horror',
                'slug' => 'horror',
                'description' => 'Stories designed to create fear, suspense, and supernatural tension.',
                'image' => 'https://placehold.co/600x400/111827/FFFFFF?text=Horror',
            ],
            [
                'name' => 'Romance',
                'slug' => 'romance',
                'description' => 'Stories focused on love, relationships, and emotional connections.',
                'image' => 'https://placehold.co/600x400/9F4B5E/FFFFFF?text=Romance',
            ],
            [
                'name' => 'Science Fiction',
                'slug' => 'science-fiction',
                'description' => 'Stories involving science, technology, space, and futuristic concepts.',
                'image' => 'https://placehold.co/600x400/315E72/FFFFFF?text=Science+Fiction',
            ],
            [
                'name' => 'Fantasy',
                'slug' => 'fantasy',
                'description' => 'Stories featuring magic, mythical creatures, and imaginary worlds.',
                'image' => 'https://placehold.co/600x400/5B4B8A/FFFFFF?text=Fantasy',
            ],
            [
                'name' => 'Adventure',
                'slug' => 'adventure',
                'description' => 'Exciting stories involving journeys, exploration, and challenges.',
                'image' => 'https://placehold.co/600x400/4D6B52/FFFFFF?text=Adventure',
            ],
            [
                'name' => 'Historical Fiction',
                'slug' => 'historical-fiction',
                'description' => 'Fictional stories set in historical periods and events.',
                'image' => 'https://placehold.co/600x400/795548/FFFFFF?text=Historical+Fiction',
            ],
            [
                'name' => 'Biography',
                'slug' => 'biography',
                'description' => 'Books about the lives and experiences of real people.',
                'image' => 'https://placehold.co/600x400/52616B/FFFFFF?text=Biography',
            ],
            [
                'name' => 'Autobiography',
                'slug' => 'autobiography',
                'description' => 'Life stories written by the people who experienced them.',
                'image' => 'https://placehold.co/600x400/607D8B/FFFFFF?text=Autobiography',
            ],
            [
                'name' => 'History',
                'slug' => 'history',
                'description' => 'Books covering historical events, civilizations, and periods.',
                'image' => 'https://placehold.co/600x400/795548/FFFFFF?text=History',
            ],
            [
                'name' => 'Psychology',
                'slug' => 'psychology',
                'description' => 'Books about human behavior, thoughts, emotions, and the mind.',
                'image' => 'https://placehold.co/600x400/6D597A/FFFFFF?text=Psychology',
            ],
            [
                'name' => 'Self-Help',
                'slug' => 'self-help',
                'description' => 'Books focused on personal growth, habits, motivation, and improvement.',
                'image' => 'https://placehold.co/600x400/4F7C70/FFFFFF?text=Self+Help',
            ],
            [
                'name' => 'Philosophy',
                'slug' => 'philosophy',
                'description' => 'Books exploring knowledge, existence, ethics, and fundamental questions.',
                'image' => 'https://placehold.co/600x400/495057/FFFFFF?text=Philosophy',
            ],
            [
                'name' => 'Science',
                'slug' => 'science',
                'description' => 'Books covering scientific discoveries, theories, and research.',
                'image' => 'https://placehold.co/600x400/386641/FFFFFF?text=Science',
            ],
            [
                'name' => 'Technology',
                'slug' => 'technology',
                'description' => 'Books about computers, programming, software, and modern technology.',
                'image' => 'https://placehold.co/600x400/2563EB/FFFFFF?text=Technology',
            ],
            [
                'name' => 'Programming',
                'slug' => 'programming',
                'description' => 'Books focused on programming languages, software development, and coding.',
                'image' => 'https://placehold.co/600x400/1E40AF/FFFFFF?text=Programming',
            ],
            [
                'name' => 'Business',
                'slug' => 'business',
                'description' => 'Books about business, entrepreneurship, management, and leadership.',
                'image' => 'https://placehold.co/600x400/334155/FFFFFF?text=Business',
            ],
            [
                'name' => 'Finance',
                'slug' => 'finance',
                'description' => 'Books about money, investing, personal finance, and financial planning.',
                'image' => 'https://placehold.co/600x400/166534/FFFFFF?text=Finance',
            ],
            [
                'name' => 'Economics',
                'slug' => 'economics',
                'description' => 'Books exploring markets, economic systems, and economic principles.',
                'image' => 'https://placehold.co/600x400/14532D/FFFFFF?text=Economics',
            ],
            [
                'name' => 'Education',
                'slug' => 'education',
                'description' => 'Books about learning, teaching, education, and academic development.',
                'image' => 'https://placehold.co/600x400/0F766E/FFFFFF?text=Education',
            ],
            [
                'name' => 'Health',
                'slug' => 'health',
                'description' => 'Books covering health, wellness, lifestyle, and healthy living.',
                'image' => 'https://placehold.co/600x400/047857/FFFFFF?text=Health',
            ],
            [
                'name' => 'Travel',
                'slug' => 'travel',
                'description' => 'Travel guides, experiences, destinations, and exploration stories.',
                'image' => 'https://placehold.co/600x400/0369A1/FFFFFF?text=Travel',
            ],
            [
                'name' => 'Cooking',
                'slug' => 'cooking',
                'description' => 'Cookbooks, recipes, culinary techniques, and food-related books.',
                'image' => 'https://placehold.co/600x400/B45309/FFFFFF?text=Cooking',
            ],
            [
                'name' => 'Children',
                'slug' => 'children',
                'description' => 'Books written for children and young readers.',
                'image' => 'https://placehold.co/600x400/CA8A04/FFFFFF?text=Children',
            ],
            [
                'name' => 'Young Adult',
                'slug' => 'young-adult',
                'description' => 'Books written primarily for teenage and young adult readers.',
                'image' => 'https://placehold.co/600x400/7C3AED/FFFFFF?text=Young+Adult',
            ],
            [
                'name' => 'Poetry',
                'slug' => 'poetry',
                'description' => 'Collections of poems and poetic works from different authors.',
                'image' => 'https://placehold.co/600x400/7C2D12/FFFFFF?text=Poetry',
            ],
            [
                'name' => 'Drama',
                'slug' => 'drama',
                'description' => 'Dramatic works, plays, and stories centered around human conflict.',
                'image' => 'https://placehold.co/600x400/4C1D95/FFFFFF?text=Drama',
            ],
        ];

        foreach ($categories as $category) {
            Category::updateOrCreate(
                [
                    'slug' => $category['slug'],
                ],
                [
                    'name' => $category['name'],
                    'description' => $category['description'],
                    'image' => $category['image'],
                    'status' => true,
                ]
            );
        }
    }
}

