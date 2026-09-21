<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Order;

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

        return view('Frontend.orders', compact('orders'));
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

        return view(
            'Frontend.order-details',
            compact('order')
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