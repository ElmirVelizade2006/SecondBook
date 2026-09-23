<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\Refund;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class RefundSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::where('role', 'admin')->first();

        if (!$admin) {
            $this->command->error('No admin found.');
            return;
        }

        Refund::where('refund_number', 'like', 'REF-SEED-%')->delete();

        $orders = Order::with('payment')
            ->whereIn('payment_status', ['paid', 'refunded'])
            ->whereIn('order_status', ['delivered', 'cancelled'])
            ->orderBy('id')
            ->take(5)
            ->get();

        if ($orders->isEmpty()) {
            $this->command->warn('No suitable orders found for refunds.');
            return;
        }

        $reasons = [
            'Customer requested a refund',
            'Book arrived damaged',
            'Wrong book received',
            'Book condition was not as described',
            'Customer changed their mind',
        ];

        foreach ($orders as $index => $order) {
            $payment = $order->payment;

            if (!$payment) {
                continue;
            }

            $amount = min(
                (float) $payment->amount,
                round((float) $payment->amount * 0.5, 2)
            );

            $statuses = [
                'pending',
                'approved',
                'processed',
                'rejected',
                'processed',
            ];

            $status = $statuses[$index % count($statuses)];

            $requestedAt = now()->subDays(rand(2, 30));

            Refund::create([
                'order_id' => $order->id,
                'payment_id' => $payment->id,
                'user_id' => $order->user_id,
                'processed_by' => in_array($status, [
                    'approved',
                    'processed',
                    'rejected',
                ]) ? $admin->id : null,
                'refund_number' => 'REF-SEED-' .
                    now()->format('Ymd') . '-' .
                    str_pad($index + 1, 4, '0', STR_PAD_LEFT),
                'amount' => $amount,
                'reason' => $reasons[$index % count($reasons)],
                'note' => 'Seeded refund record.',
                'status' => $status,
                'requested_at' => $requestedAt,
                'processed_at' => in_array($status, [
                    'approved',
                    'processed',
                    'rejected',
                ])
                    ? $requestedAt->copy()->addHours(rand(2, 48))
                    : null,
            ]);
        }

        $this->command->info('Seeded refund records successfully.');
    }
}