<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\Order;
use App\Models\Payment;
use App\Models\Store;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class SellerOrdersSeeder extends Seeder
{
    public function run(): void
    {
        $sellers = User::where('role', 'seller')
            ->with('store')
            ->get();

        $buyers = User::where('role', 'user')->get();

        if ($sellers->isEmpty() || $buyers->isEmpty()) {
            $this->command->error('Sellers or buyers not found.');
            return;
        }

        Order::where('note', 'Seeded marketplace order.')
            ->get()
            ->each(function ($order) {
                $order->payment?->delete();
                $order->refunds()->delete();
                $order->delete();
            });

        $books = Book::whereNotNull('seller_id')
            ->where('status', 'approved')
            ->where('stock', '>', 0)
            ->with('seller.store')
            ->get();

        $statuses = [
            ['pending', 'pending', 'cash_on_delivery'],
            ['processing', 'paid', 'credit_card'],
            ['shipped', 'paid', 'debit_card'],
            ['delivered', 'paid', 'paypal'],
            ['delivered', 'paid', 'cash_on_delivery'],
            ['cancelled', 'failed', 'credit_card'],
            ['processing', 'paid', 'paypal'],
            ['shipped', 'paid', 'credit_card'],
            ['delivered', 'paid', 'debit_card'],
            ['delivered', 'refunded', 'credit_card'],
        ];

        foreach ($statuses as $index => [$orderStatus, $paymentStatus, $paymentMethod]) {
            $book = $books[$index % $books->count()];
            $buyer = $buyers[$index % $buyers->count()];
            $store = $book->seller?->store;

            if (!$store) {
                continue;
            }

            $quantity = min(
                rand(1, 2),
                max(1, (int) $book->stock)
            );

            $bookPrice = (float) $book->price;
            $subtotal = round($bookPrice * $quantity, 2);
            $shippingFee = 0;
            $total = $subtotal + $shippingFee;

            $orderNumber = 'SB-SEED-' .
                now()->format('Ymd') . '-' .
                str_pad($index + 1, 4, '0', STR_PAD_LEFT);

            $order = Order::create([
                'order_number' => $orderNumber,
                'user_id' => $buyer->id,
                'book_id' => $book->id,
                'book_price' => $bookPrice,
                'quantity' => $quantity,
                'total_price' => $total,
                'shipping_fee' => $shippingFee,
                'payment_method' => $paymentMethod,
                'payment_status' => $paymentStatus,
                'order_status' => $orderStatus,
                'processing_deadline' => now()->addDays(
                    $store->processing_time ?? 2
                ),
                'order_note' => $store->order_note,
                'full_name' => $buyer->name,
                'phone' => $buyer->phone ?? '+994500000000',
                'country' => $buyer->country ?? 'Azerbaijan',
                'city' => $buyer->city ?? 'Baku',
                'postal_code' => $buyer->postal_code ?? 'AZ1000',
                'address' => $buyer->address ?? 'Baku, Azerbaijan',
                'delivery_estimate' => '3-5 business days',
                'note' => 'Seeded marketplace order.',
            ]);

            Payment::create([
                'transaction_id' => 'TXN-' . strtoupper(Str::random(12)),
                'order_id' => $order->id,
                'amount' => $total,
                'payment_method' => $paymentMethod,
                'payment_status' => $paymentStatus,
                'paid_at' => $paymentStatus === 'paid' || $paymentStatus === 'refunded'
                    ? now()->subDays(rand(1, 20))
                    : null,
                'note' => 'Seeded payment record.',
            ]);
        }

        $this->command->info('Seeded seller orders and payments successfully.');
    }
}