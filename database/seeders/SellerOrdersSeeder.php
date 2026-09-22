<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\Order;
use App\Models\User;
use Illuminate\Database\Seeder;

class SellerOrdersSeeder extends Seeder
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
        | Find Seller Store
        |--------------------------------------------------------------------------
        */

        $store = $seller->store;

        if (!$store) {
            $this->command->error(
                'No store found for this seller.'
            );

            return;
        }


        /*
        |--------------------------------------------------------------------------
        | Find Buyer
        |--------------------------------------------------------------------------
        */

        $buyer = User::where('role', 'user')->first();

        if (!$buyer) {
            $this->command->error('No buyer user found.');
            return;
        }


        /*
        |--------------------------------------------------------------------------
        | Get Seller Books
        |--------------------------------------------------------------------------
        */

        $books = Book::where('seller_id', $seller->id)
            ->get();

        if ($books->isEmpty()) {
            $this->command->error(
                'No books found for this seller. Please run SellerBooksSeeder first.'
            );

            return;
        }


        /*
        |--------------------------------------------------------------------------
        | Delete Old Test Orders
        |--------------------------------------------------------------------------
        */

        Order::where(
            'note',
            'Test order created for Seller Panel testing.'
        )->delete();


        /*
        |--------------------------------------------------------------------------
        | Test Orders
        |--------------------------------------------------------------------------
        */

        $orders = [

            [
                'status' => 'pending',
                'payment_status' => 'pending',
                'payment_method' => 'cash_on_delivery',
                'quantity' => 1,
            ],

            [
                'status' => 'processing',
                'payment_status' => 'paid',
                'payment_method' => 'credit_card',
                'quantity' => 2,
            ],

            [
                'status' => 'shipped',
                'payment_status' => 'paid',
                'payment_method' => 'debit_card',
                'quantity' => 1,
            ],

            [
                'status' => 'delivered',
                'payment_status' => 'paid',
                'payment_method' => 'paypal',
                'quantity' => 3,
            ],

            [
                'status' => 'cancelled',
                'payment_status' => 'failed',
                'payment_method' => 'credit_card',
                'quantity' => 1,
            ],

            [
                'status' => 'pending',
                'payment_status' => 'paid',
                'payment_method' => 'debit_card',
                'quantity' => 2,
            ],

            [
                'status' => 'processing',
                'payment_status' => 'paid',
                'payment_method' => 'paypal',
                'quantity' => 1,
            ],

            [
                'status' => 'shipped',
                'payment_status' => 'paid',
                'payment_method' => 'credit_card',
                'quantity' => 2,
            ],

            [
                'status' => 'delivered',
                'payment_status' => 'paid',
                'payment_method' => 'cash_on_delivery',
                'quantity' => 1,
            ],

            [
                'status' => 'delivered',
                'payment_status' => 'refunded',
                'payment_method' => 'credit_card',
                'quantity' => 1,
            ],

        ];


        /*
        |--------------------------------------------------------------------------
        | Create Orders
        |--------------------------------------------------------------------------
        */

        foreach ($orders as $index => $orderData) {

            $book = $books[$index % $books->count()];

            $quantity = $orderData['quantity'];

            $bookPrice = $book->price;

            $totalPrice = $bookPrice * $quantity;

            $processingDeadline = now()->addDays(
                $store->processing_time
            );


            Order::create([

                'order_number' => 'TEST-' .
                    now()->format('Ymd') .
                    '-' .
                    str_pad(
                        $index + 1,
                        3,
                        '0',
                        STR_PAD_LEFT
                    ),

                'user_id' => $buyer->id,

                'book_id' => $book->id,

                'book_price' => $bookPrice,

                'quantity' => $quantity,

                'total_price' => $totalPrice,

                'payment_method' => $orderData['payment_method'],

                'payment_status' => $orderData['payment_status'],

                'order_status' => $orderData['status'],

                'processing_deadline' => $processingDeadline,

                'full_name' => $buyer->name ?? 'Test Customer',

                'phone' => $buyer->phone ?? '+994500000000',

                'country' => $buyer->country ?? 'Azerbaijan',

                'city' => $buyer->city ?? 'Baku',

                'postal_code' => $buyer->postal_code ?? 'AZ1000',

                'address' => $buyer->address ?? 'Test Customer Address',

                'note' => 'Test order created for Seller Panel testing.',

            ]);
        }


        /*
        |--------------------------------------------------------------------------
        | Success Message
        |--------------------------------------------------------------------------
        */

        $this->command->info(
            '10 seller test orders created successfully with processing deadlines.'
        );
    }
}