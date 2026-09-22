<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\Refund;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class RefundSeeder extends Seeder
{
    public function run(): void
    {
        $orders = Order::with('user')
            ->latest()
            ->get();

        $admin = User::where('role', 'admin')->first();

        if ($orders->isEmpty()) {
            $this->command->warn('No orders found. RefundSeeder skipped.');
            return;
        }

        if (!$admin) {
            $this->command->warn('No admin user found. RefundSeeder skipped.');
            return;
        }

        $reasons = [
            'Customer requested a refund',
            'Book arrived damaged',
            'Wrong book received',
            'Book condition was not as described',
            'Customer changed their mind',
            'Duplicate order',
            'Order was cancelled',
            'Book was unavailable',
            'Shipping issue',
            'Payment issue',
            'Customer received the wrong edition',
            'Book had missing pages',
            'Book cover was damaged',
            'Seller could not fulfill the order',
            'Customer requested partial refund',
        ];

        $notes = [
            'Refund requested by the customer.',
            'Customer contacted support regarding this order.',
            'Refund approved after reviewing the order.',
            'Refund processed successfully.',
            'Customer provided photos of the damaged book.',
            'Order details were reviewed by the support team.',
            'Partial refund issued to the customer.',
            'Payment information was checked before processing.',
            'Refund cancelled by administrator.',
            'Refund request rejected after review.',
            'Customer and seller communication was reviewed.',
            null,
            null,
            null,
        ];

        $statuses = [
            'pending',
            'pending',
            'pending',
            'approved',
            'approved',
            'rejected',
            'processed',
            'processed',
            'processed',
            'cancelled',
        ];

        $refundCounter = 1;

        foreach ($orders as $order) {

            /*
            |--------------------------------------------------------------------------
            | Create 10 refunds for each order
            |--------------------------------------------------------------------------
            */

            $orderAmount = (float) $order->total_price;

            /*
             * Keep every refund small enough so that the total seeded
             * refund amount stays below the original order amount.
             */
            $refundAmount = round($orderAmount / 20, 2);

            if ($refundAmount < 0.01) {
                $refundAmount = 0.01;
            }

            for ($i = 0; $i < 10; $i++) {

                $status = $statuses[$i];

                $requestedAt = Carbon::now()
                    ->subDays(rand(1, 90))
                    ->subHours(rand(1, 23))
                    ->subMinutes(rand(1, 59));

                $processedAt = null;
                $processedBy = null;

                if (in_array($status, [
                    'approved',
                    'rejected',
                    'processed',
                    'cancelled',
                ])) {
                    $processedAt = (clone $requestedAt)
                        ->addHours(rand(2, 72));

                    $processedBy = $admin->id;
                }

                $refundNumber = 'REF-' . now()->format('Ymd') . '-' .
                    str_pad($refundCounter, 4, '0', STR_PAD_LEFT);

                Refund::updateOrCreate(
                    [
                        'refund_number' => $refundNumber,
                    ],
                    [
                        'order_id' => $order->id,
                        'payment_id' => null,
                        'user_id' => $order->user_id,
                        'processed_by' => $processedBy,
                        'amount' => $refundAmount,
                        'reason' => $reasons[array_rand($reasons)],
                        'note' => $notes[array_rand($notes)],
                        'status' => $status,
                        'requested_at' => $requestedAt,
                        'processed_at' => $processedAt,
                    ]
                );

                $refundCounter++;
            }
        }

        $this->command->info(
            ($refundCounter - 1) . ' refunds created successfully.'
        );
        $this->call([
            RolePermissionSeeder::class,
            UserSeeder::class,
            CategorySeeder::class,
            PublisherSeeder::class,
            AuthorSeeder::class,
            BookSeeder::class,
            StoreSeeder::class,
            SellerBooksSeeder::class,
            SellerOrdersSeeder::class,
            RefundSeeder::class,
        ]);
    }
}