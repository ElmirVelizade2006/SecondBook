<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Order;
use Illuminate\Http\Request;

class SellerDashboardController extends Controller
{
    public function index()
    {
        $sellerId = auth()->id();

        $totalBooks = Book::where('seller_id', $sellerId)->count();

        $pendingBooks = Book::where('seller_id', $sellerId)
            ->where('status', 'pending')
            ->count();

        $totalOrders = Order::whereHas('book', function ($query) use ($sellerId) {
            $query->where('seller_id', $sellerId);
        })->count();

        $totalSales = Order::whereHas('book', function ($query) use ($sellerId) {
            $query->where('seller_id', $sellerId);
        })
        ->where('order_status', 'delivered')
        ->sum('total_price');

        $recentOrders = Order::with(['user', 'book'])
            ->whereHas('book', function ($query) use ($sellerId) {
                $query->where('seller_id', $sellerId);
            })
            ->latest()
            ->take(5)
            ->get();

        return view('seller.dashboard', compact(
            'totalBooks',
            'pendingBooks',
            'totalOrders',
            'totalSales',
            'recentOrders'
        ));
    }
}