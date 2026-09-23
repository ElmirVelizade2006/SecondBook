<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FAQSeeder extends Seeder
{
    public function run(): void
    {
        $faqs = [
            [
                'category' => 'Orders',
                'question' => 'How can I place an order?',
                'answer' => 'Add the books you want to your cart, proceed to checkout, enter your shipping information, select a payment method, and confirm your order.',
                'sort_order' => 1,
            ],
            [
                'category' => 'Orders',
                'question' => 'Where can I see my orders?',
                'answer' => 'You can view your orders from the Orders section of your account.',
                'sort_order' => 2,
            ],
            [
                'category' => 'Shipping',
                'question' => 'How long does delivery take?',
                'answer' => 'Standard delivery usually takes 3-5 business days.',
                'sort_order' => 3,
            ],
            [
                'category' => 'Shipping',
                'question' => 'Do you offer international shipping?',
                'answer' => 'Yes, international shipping is available for selected destinations.',
                'sort_order' => 4,
            ],
            [
                'category' => 'Payments',
                'question' => 'Which payment methods are supported?',
                'answer' => 'SecondBook supports cash on delivery, credit card, debit card, and PayPal.',
                'sort_order' => 5,
            ],
            [
                'category' => 'Returns',
                'question' => 'Can I request a refund?',
                'answer' => 'Refund requests can be submitted from the appropriate order section when the order qualifies for a refund.',
                'sort_order' => 6,
            ],
            [
                'category' => 'Account',
                'question' => 'How can I change my account information?',
                'answer' => 'You can update your profile information from your account settings.',
                'sort_order' => 7,
            ],
            [
                'category' => 'Sellers',
                'question' => 'How can I become a seller?',
                'answer' => 'Registered users can submit a seller application with their store information for review.',
                'sort_order' => 8,
            ],
            [
                'category' => 'Books',
                'question' => 'Can sellers list used books?',
                'answer' => 'Yes. Sellers can list books and specify their condition before submitting them for marketplace approval.',
                'sort_order' => 9,
            ],
            [
                'category' => 'Reviews',
                'question' => 'Can I review a book I purchased?',
                'answer' => 'Yes. Customers can submit reviews for books they have purchased.',
                'sort_order' => 10,
            ],
        ];

        foreach ($faqs as $faq) {
            DB::table('faqs')->updateOrInsert(
                [
                    'question' => $faq['question'],
                ],
                array_merge($faq, [
                    'is_active' => true,
                    'updated_at' => now(),
                    'created_at' => now(),
                ])
            );
        }
    }
}