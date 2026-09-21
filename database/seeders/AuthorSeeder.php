<?php

namespace Database\Seeders;

use App\Models\Author;
use Illuminate\Database\Seeder;

class AuthorSeeder extends Seeder
{
    public function run(): void
    {
        $authors = [
            [
                'name' => 'Jane Austen',
                'bio' => 'English novelist known for her sharp observations of society, relationships, and marriage.',
                'photo' => 'https://i.pravatar.cc/600?img=1',
                'status' => true,
            ],
            [
                'name' => 'George Orwell',
                'bio' => 'English novelist and essayist best known for works exploring politics, society, freedom, and totalitarianism.',
                'photo' => 'https://i.pravatar.cc/600?img=2',
                'status' => true,
            ],
            [
                'name' => 'Haruki Murakami',
                'bio' => 'Japanese novelist whose works combine everyday life, surreal elements, loneliness, memory, and music.',
                'photo' => 'https://i.pravatar.cc/600?img=3',
                'status' => true,
            ],
            [
                'name' => 'Agatha Christie',
                'bio' => 'British mystery writer famous for Hercule Poirot, Miss Marple, and detective novels.',
                'photo' => 'https://i.pravatar.cc/600?img=4',
                'status' => true,
            ],
            [
                'name' => 'Elchin Safarli',
                'bio' => 'Azerbaijani writer and journalist known for emotional novels about love, memories, family, and relationships.',
                'photo' => 'https://i.pravatar.cc/600?img=5',
                'status' => true,
            ],
            [
                'name' => 'Ismail Kadare',
                'bio' => 'Albanian novelist and poet known for historical, political, and literary works exploring society, power, identity, and human nature.',
                'photo' => 'https://i.pravatar.cc/600?img=31',
                'status' => true,
            ],
            [
                'name' => 'Yuval Noah Harari',
                'bio' => 'Historian and author whose works explore human history, society, technology, and the future of humanity.',
                'photo' => 'https://i.pravatar.cc/600?img=6',
                'status' => true,
            ],
            [
                'name' => 'Paulo Coelho',
                'bio' => 'Brazilian novelist whose books explore spirituality, personal journeys, dreams, destiny, and self-discovery.',
                'photo' => 'https://i.pravatar.cc/600?img=7',
                'status' => true,
            ],
            [
                'name' => 'Malala Yousafzai',
                'bio' => 'Author and education activist known for advocating for girls education and access to schooling.',
                'photo' => 'https://i.pravatar.cc/600?img=8',
                'status' => true,
            ],
            [
                'name' => 'Stephen King',
                'bio' => 'American author widely known for horror, supernatural fiction, suspense, and fantasy novels.',
                'photo' => 'https://i.pravatar.cc/600?img=9',
                'status' => true,
            ],
            [
                'name' => 'Erich Fromm',
                'bio' => 'German-American social psychologist and author whose works examine love, freedom, human nature, and society.',
                'photo' => 'https://i.pravatar.cc/600?img=10',
                'status' => true,
            ],
            [
                'name' => 'Leo Tolstoy',
                'bio' => 'Russian novelist and philosopher regarded as one of the major figures of world literature.',
                'photo' => 'https://i.pravatar.cc/600?img=11',
                'status' => true,
            ],
            [
                'name' => 'Fyodor Dostoevsky',
                'bio' => 'Russian novelist whose works explore morality, psychology, faith, suffering, freedom, and human nature.',
                'photo' => 'https://i.pravatar.cc/600?img=12',
                'status' => true,
            ],
            [
                'name' => 'Gabriel Garcia Marquez',
                'bio' => 'Colombian novelist and journalist celebrated for his influential works of magical realism.',
                'photo' => 'https://i.pravatar.cc/600?img=13',
                'status' => true,
            ],
            [
                'name' => 'Franz Kafka',
                'bio' => 'German-speaking Bohemian writer known for themes of alienation, anxiety, bureaucracy, and the absurd.',
                'photo' => 'https://i.pravatar.cc/600?img=14',
                'status' => true,
            ],
            [
                'name' => 'J.K. Rowling',
                'bio' => 'British author best known for creating the Harry Potter fantasy series.',
                'photo' => 'https://i.pravatar.cc/600?img=15',
                'status' => true,
            ],
            [
                'name' => 'J.R.R. Tolkien',
                'bio' => 'English writer and academic best known for creating Middle-earth and influential works of modern fantasy.',
                'photo' => 'https://i.pravatar.cc/600?img=16',
                'status' => true,
            ],
            [
                'name' => 'Antoine de Saint-Exupery',
                'bio' => 'French writer, poet, aviator, and journalist known for philosophical and poetic literary works.',
                'photo' => 'https://i.pravatar.cc/600?img=17',
                'status' => true,
            ],
            [
                'name' => 'Daniel Kahneman',
                'bio' => 'Psychologist and author known for influential research on judgment, decision-making, and behavioral economics.',
                'photo' => 'https://i.pravatar.cc/600?img=18',
                'status' => true,
            ],
            [
                'name' => 'James Clear',
                'bio' => 'Author and speaker focused on habits, decision-making, continuous improvement, and personal development.',
                'photo' => 'https://i.pravatar.cc/600?img=19',
                'status' => true,
            ],
            [
                'name' => 'Stephen Hawking',
                'bio' => 'British theoretical physicist and author known for making complex ideas about cosmology accessible to general readers.',
                'photo' => 'https://i.pravatar.cc/600?img=20',
                'status' => true,
            ],
            [
                'name' => 'Walter Isaacson',
                'bio' => 'American writer and journalist known for biographies of influential figures in science, technology, business, and culture.',
                'photo' => 'https://i.pravatar.cc/600?img=21',
                'status' => true,
            ],
            [
                'name' => 'Robert C. Martin',
                'bio' => 'American software engineer and author known for his work on clean code, software craftsmanship, and agile development.',
                'photo' => 'https://i.pravatar.cc/600?img=22',
                'status' => true,
            ],
            [
                'name' => 'Brian Kernighan',
                'bio' => 'Canadian computer scientist and author known for influential contributions to programming and computer science education.',
                'photo' => 'https://i.pravatar.cc/600?img=23',
                'status' => true,
            ],
            [
                'name' => 'Martin Fowler',
                'bio' => 'British software developer and author known for software architecture, refactoring, and enterprise development.',
                'photo' => 'https://i.pravatar.cc/600?img=24',
                'status' => true,
            ],
            [
                'name' => 'Morgan Housel',
                'bio' => 'American author known for writing about money, investing, behavior, psychology, and financial decision-making.',
                'photo' => 'https://i.pravatar.cc/600?img=25',
                'status' => true,
            ],
            [
                'name' => 'Markus Zusak',
                'bio' => 'Australian author known for literary fiction exploring childhood, war, family, loss, and resilience.',
                'photo' => 'https://i.pravatar.cc/600?img=26',
                'status' => true,
            ],
            [
                'name' => 'Umberto Eco',
                'bio' => 'Italian novelist, literary critic, philosopher, and semiotician known for intellectually rich historical fiction.',
                'photo' => 'https://i.pravatar.cc/600?img=27',
                'status' => true,
            ],
            [
                'name' => 'Matt Haig',
                'bio' => 'British author known for novels and nonfiction exploring modern life, relationships, time, and existence.',
                'photo' => 'https://i.pravatar.cc/600?img=28',
                'status' => true,
            ],
            [
                'name' => 'Alex Michaelides',
                'bio' => 'Cypriot-British author and screenwriter known for psychological thriller novels and complex mysteries.',
                'photo' => 'https://i.pravatar.cc/600?img=29',
                'status' => true,
            ],
            [
                'name' => 'Neil Gaiman',
                'bio' => 'English author known for fantasy, mythology, comics, novels, and imaginative storytelling.',
                'photo' => 'https://i.pravatar.cc/600?img=30',
                'status' => true,
            ],
        ];

        foreach ($authors as $author) {
            Author::updateOrCreate(
                ['name' => $author['name']],
                [
                    'bio' => $author['bio'],
                    'photo' => $author['photo'],
                    'status' => $author['status'],
                ]
            );
        }
    }
}

