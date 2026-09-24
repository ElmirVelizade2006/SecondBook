<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Review;
use App\Models\Setting;
use Illuminate\Support\Facades\DB;

class OrdersController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | My Orders
    |--------------------------------------------------------------------------
    */

    public function index()
    {
        $orders = Order::with('book')
            ->where('user_id', auth()->id())
            ->latest()
            ->paginate(10);

        $reviewedBookIds = Review::where('user_id', auth()->id())
            ->pluck('book_id')
            ->toArray();

        $cancelOrderPeriod = (int) Setting::get(
            'cancel_order_period',
            0
        );

        return view(
            'Frontend.orders',
            compact(
                'orders',
                'reviewedBookIds',
                'cancelOrderPeriod'
            )
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Order Details
    |--------------------------------------------------------------------------
    */

    public function show(Order $order)
    {
        abort_unless(
            $order->user_id === auth()->id(),
            403
        );

        $order->load([
            'book.author',
            'payment',
        ]);

        $reviewed = Review::where('user_id', auth()->id())
            ->where('book_id', $order->book_id)
            ->exists();

        $cancelOrderPeriod = (int) Setting::get(
            'cancel_order_period',
            0
        );

        return view(
            'Frontend.order-details',
            compact(
                'order',
                'reviewed',
                'cancelOrderPeriod'
            )
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Cancel Order
    |--------------------------------------------------------------------------
    */

    public function cancel(Order $order)
    {
        abort_unless(
            $order->user_id === auth()->id(),
            403
        );

        $cancelOrderPeriod = (int) Setting::get(
            'cancel_order_period',
            0
        );

        if ($cancelOrderPeriod <= 0) {
            return back()->with(
                'error',
                'Order cancellation is currently disabled.'
            );
        }

        if (
            in_array(
                $order->order_status,
                ['shipped', 'delivered', 'cancelled'],
                true
            )
        ) {
            return back()->with(
                'error',
                'This order can no longer be cancelled.'
            );
        }

        if (
            $order->created_at
                ->copy()
                ->addDays($cancelOrderPeriod)
                ->isPast()
        ) {
            return back()->with(
                'error',
                'The cancellation period for this order has expired.'
            );
        }

        try {
            DB::transaction(function () use ($order) {
                $lockedOrder = Order::where('id', $order->id)
                    ->lockForUpdate()
                    ->firstOrFail();

                if (
                    in_array(
                        $lockedOrder->order_status,
                        ['shipped', 'delivered', 'cancelled'],
                        true
                    )
                ) {
                    throw new \RuntimeException(
                        'This order can no longer be cancelled.'
                    );
                }

                $book = $lockedOrder->book()
                    ->lockForUpdate()
                    ->first();

                if ($book) {
                    $book->increment(
                        'stock',
                        $lockedOrder->quantity
                    );
                }

                $lockedOrder->update([
                    'order_status' => 'cancelled',
                ]);
            });

            return back()->with(
                'success',
                'Order cancelled successfully.'
            );

        } catch (\RuntimeException $e) {
            return back()->with(
                'error',
                $e->getMessage()
            );

        } catch (\Throwable $e) {
            report($e);

            return back()->with(
                'error',
                'Something went wrong while cancelling the order.'
            );
        }
    }


    /*
    |--------------------------------------------------------------------------
    | Order Tracking
    |--------------------------------------------------------------------------
    */

    public function tracking(Order $order)
    {
        abort_unless(
            $order->user_id === auth()->id(),
            403
        );

        $order->load('book');

        $statuses = [
            'pending' => [
                'label' => 'Order Placed',
                'icon' => 'bi-bag-check',
                'description' => 'Your order has been placed successfully.',
            ],

            'processing' => [
                'label' => 'Processing',
                'icon' => 'bi-box-seam',
                'description' => 'Your order is being prepared.',
            ],

            'shipped' => [
                'label' => 'Shipped',
                'icon' => 'bi-truck',
                'description' => 'Your order has been shipped.',
            ],

            'delivered' => [
                'label' => 'Delivered',
                'icon' => 'bi-house-check',
                'description' => 'Your order has been delivered successfully.',
            ],
        ];

        return view(
            'Frontend.order-tracking',
            compact(
                'order',
                'statuses'
            )
        );
    }
}