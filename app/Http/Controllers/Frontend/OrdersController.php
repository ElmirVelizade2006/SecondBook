<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Review;

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

        /*
        |--------------------------------------------------------------------------
        | Reviewed Books
        |--------------------------------------------------------------------------
        */

        $reviewedBookIds = Review::where('user_id', auth()->id())
            ->pluck('book_id')
            ->toArray();

        return view(
            'Frontend.orders',
            compact(
                'orders',
                'reviewedBookIds'
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

        return view(
            'Frontend.order-details',
            compact(
                'order',
                'reviewed'
            )
        );
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