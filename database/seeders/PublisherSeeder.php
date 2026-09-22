<?php

namespace Database\Seeders;

use App\Models\Publisher;
use Illuminate\Database\Seeder;

class PublisherSeeder extends Seeder
{
    public function run(): void
    {
        $publishers = [

            [
                'name' => 'Penguin Random House',
                'logo' => 'https://www.google.com/s2/favicons?domain=penguinrandomhouse.com&sz=128',
                'country' => 'United States',
                'website' => 'https://www.penguinrandomhouse.com',
                'description' => 'One of the world\'s largest trade book publishers.',
                'status' => true,
            ],

            [
                'name' => 'HarperCollins',
                'logo' => 'https://www.google.com/s2/favicons?domain=harpercollins.com&sz=128',
                'country' => 'United States',
                'website' => 'https://www.harpercollins.com',
                'description' => 'A major international publishing company with a wide range of books and authors.',
                'status' => true,
            ],

            [
                'name' => 'Simon & Schuster',
                'logo' => 'https://www.google.com/s2/favicons?domain=simonandschuster.com&sz=128',
                'country' => 'United States',
                'website' => 'https://www.simonandschuster.com',
                'description' => 'A major American publishing company publishing fiction, nonfiction and educational titles.',
                'status' => true,
            ],

            [
                'name' => 'Macmillan Publishers',
                'logo' => 'https://www.google.com/s2/favicons?domain=macmillan.com&sz=128',
                'country' => 'United Kingdom',
                'website' => 'https://www.macmillan.com',
                'description' => 'An international publishing company with a long history in book publishing.',
                'status' => true,
            ],

            [
                'name' => 'Hachette Book Group',
                'logo' => 'https://www.google.com/s2/favicons?domain=hachettebookgroup.com&sz=128',
                'country' => 'United States',
                'website' => 'https://www.hachettebookgroup.com',
                'description' => 'A leading US trade publishing company and part of Hachette Livre.',
                'status' => true,
            ],

            [
                'name' => 'Oxford University Press',
                'logo' => 'https://www.google.com/s2/favicons?domain=oup.com&sz=128',
                'country' => 'United Kingdom',
                'website' => 'https://global.oup.com',
                'description' => 'The publishing department of the University of Oxford.',
                'status' => true,
            ],

            [
                'name' => 'Cambridge University Press',
                'logo' => 'https://www.google.com/s2/favicons?domain=cambridge.org&sz=128',
                'country' => 'United Kingdom',
                'website' => 'https://www.cambridge.org',
                'description' => 'A major academic publisher associated with the University of Cambridge.',
                'status' => true,
            ],

            [
                'name' => 'Scholastic',
                'logo' => 'https://www.google.com/s2/favicons?domain=scholastic.com&sz=128',
                'country' => 'United States',
                'website' => 'https://www.scholastic.com',
                'description' => 'A global publishing and education company specializing in books for children and young readers.',
                'status' => true,
            ],

            [
                'name' => 'Bloomsbury Publishing',
                'logo' => 'https://www.google.com/s2/favicons?domain=bloomsbury.com&sz=128',
                'country' => 'United Kingdom',
                'website' => 'https://www.bloomsbury.com',
                'description' => 'An independent international publishing house known for fiction and academic publishing.',
                'status' => true,
            ],

            [
                'name' => 'O\'Reilly Media',
                'logo' => 'https://www.google.com/s2/favicons?domain=oreilly.com&sz=128',
                'country' => 'United States',
                'website' => 'https://www.oreilly.com',
                'description' => 'A publisher and technology learning company known for technical books and resources.',
                'status' => true,
            ],

            [
                'name' => 'Wiley',
                'logo' => 'https://www.google.com/s2/favicons?domain=wiley.com&sz=128',
                'country' => 'United States',
                'website' => 'https://www.wiley.com',
                'description' => 'An international publisher focused on academic, scientific and professional content.',
                'status' => true,
            ],

            [
                'name' => 'Pearson',
                'logo' => 'https://www.google.com/s2/favicons?domain=pearson.com&sz=128',
                'country' => 'United Kingdom',
                'website' => 'https://www.pearson.com',
                'description' => 'A global education and publishing company providing learning content and services.',
                'status' => true,
            ],

            [
                'name' => 'Springer Nature',
                'logo' => 'https://www.google.com/s2/favicons?domain=springernature.com&sz=128',
                'country' => 'Germany',
                'website' => 'https://www.springernature.com',
                'description' => 'A major academic publishing company focused on research and scientific content.',
                'status' => true,
            ],

            [
                'name' => 'Elsevier',
                'logo' => 'https://www.google.com/s2/favicons?domain=elsevier.com&sz=128',
                'country' => 'Netherlands',
                'website' => 'https://www.elsevier.com',
                'description' => 'A global information and analytics company serving research and academic communities.',
                'status' => true,
            ],

            [
                'name' => 'Routledge',
                'logo' => 'https://www.google.com/s2/favicons?domain=routledge.com&sz=128',
                'country' => 'United Kingdom',
                'website' => 'https://www.routledge.com',
                'description' => 'A major academic publisher specializing in humanities and social sciences.',
                'status' => true,
            ],

            [
                'name' => 'W. W. Norton & Company',
                'logo' => 'https://www.google.com/s2/favicons?domain=wwnorton.com&sz=128',
                'country' => 'United States',
                'website' => 'https://wwnorton.com',
                'description' => 'An independent American publishing company known for academic and trade books.',
                'status' => true,
            ],

            [
                'name' => 'Faber & Faber',
                'logo' => 'https://www.google.com/s2/favicons?domain=faber.co.uk&sz=128',
                'country' => 'United Kingdom',
                'website' => 'https://www.faber.co.uk',
                'description' => 'An independent British publishing house known for literary fiction, poetry and nonfiction.',
                'status' => true,
            ],

            [
                'name' => 'Random House',
                'logo' => 'https://www.google.com/s2/favicons?domain=randomhousebooks.com&sz=128',
                'country' => 'United States',
                'website' => 'https://www.randomhousebooks.com',
                'description' => 'A major publishing imprint associated with Penguin Random House.',
                'status' => true,
            ],

            [
                'name' => 'Vintage Books',
                'logo' => 'https://www.google.com/s2/favicons?domain=penguinrandomhouse.com&sz=128',
                'country' => 'United States',
                'website' => 'https://www.penguinrandomhouse.com',
                'description' => 'A well-known publishing imprint focused on literary and contemporary works.',
                'status' => true,
            ],

            [
                'name' => 'Bantam Books',
                'logo' => 'https://www.google.com/s2/favicons?domain=penguinrandomhouse.com&sz=128',
                'country' => 'United States',
                'website' => 'https://www.penguinrandomhouse.com',
                'description' => 'A long-established publishing imprint associated with Penguin Random House.',
                'status' => true,
            ],

            [
                'name' => 'Doubleday',
                'logo' => 'https://www.google.com/s2/favicons?domain=penguinrandomhouse.com&sz=128',
                'country' => 'United States',
                'website' => 'https://www.penguinrandomhouse.com',
                'description' => 'A historic American publishing imprint known for fiction and nonfiction.',
                'status' => true,
            ],

            [
                'name' => 'Kensington Publishing',
                'logo' => 'https://www.google.com/s2/favicons?domain=kensingtonbooks.com&sz=128',
                'country' => 'United States',
                'website' => 'https://www.kensingtonbooks.com',
                'description' => 'An independent American publisher of fiction and nonfiction.',
                'status' => true,
            ],

            [
                'name' => 'Grand Central Publishing',
                'logo' => 'https://www.google.com/s2/favicons?domain=hachettebookgroup.com&sz=128',
                'country' => 'United States',
                'website' => 'https://www.hachettebookgroup.com',
                'description' => 'A major publishing imprint of Hachette Book Group.',
                'status' => true,
            ],

            [
                'name' => 'Little, Brown and Company',
                'logo' => 'https://www.google.com/s2/favicons?domain=hachettebookgroup.com&sz=128',
                'country' => 'United States',
                'website' => 'https://www.hachettebookgroup.com',
                'description' => 'A historic American publishing house and Hachette Book Group imprint.',
                'status' => true,
            ],

            [
                'name' => 'Pan Macmillan',
                'logo' => 'https://www.google.com/s2/favicons?domain=panmacmillan.com&sz=128',
                'country' => 'United Kingdom',
                'website' => 'https://www.panmacmillan.com',
                'description' => 'A leading UK publishing company and part of the Macmillan group.',
                'status' => true,
            ],

            [
                'name' => 'Canongate Books',
                'logo' => 'https://www.google.com/s2/favicons?domain=canongate.co.uk&sz=128',
                'country' => 'United Kingdom',
                'website' => 'https://canongate.co.uk',
                'description' => 'An independent Scottish publishing company known for literary works.',
                'status' => true,
            ],

            [
                'name' => 'Schirmer/Mosel',
                'logo' => 'https://www.google.com/s2/favicons?domain=schirmer-mosel.com&sz=128',
                'country' => 'Germany',
                'website' => 'https://www.schirmer-mosel.com',
                'description' => 'A German publisher specializing in art, photography and culture.',
                'status' => true,
            ],

            [
                'name' => 'Gallimard',
                'logo' => 'https://www.google.com/s2/favicons?domain=gallimard.fr&sz=128',
                'country' => 'France',
                'website' => 'https://www.gallimard.fr',
                'description' => 'One of France\'s most prominent literary publishing houses.',
                'status' => true,
            ],

            [
                'name' => 'Editorial Planeta',
                'logo' => 'https://www.google.com/s2/favicons?domain=planeta.es&sz=128',
                'country' => 'Spain',
                'website' => 'https://www.planeta.es',
                'description' => 'A major Spanish publishing group with an international presence.',
                'status' => true,
            ],

            [
                'name' => 'Kodansha',
                'logo' => 'https://www.google.com/s2/favicons?domain=kodansha.co.jp&sz=128',
                'country' => 'Japan',
                'website' => 'https://www.kodansha.co.jp',
                'description' => 'A major Japanese publishing company known for books, magazines and manga.',
                'status' => true,
            ],

        ];

        foreach ($publishers as $publisher) {
            Publisher::create($publisher);
        }
    }
}