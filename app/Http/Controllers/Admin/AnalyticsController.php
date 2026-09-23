<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Order;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AnalyticsController extends Controller
{
    public function index(Request $request)
    {
        $startDate = $request->filled('start_date')
            ? Carbon::parse($request->start_date)->startOfDay()
            : now()->startOfMonth();

        $endDate = $request->filled('end_date')
            ? Carbon::parse($request->end_date)->endOfDay()
            : now()->endOfDay();

        /*
        |--------------------------------------------------------------------------
        | Orders
        |--------------------------------------------------------------------------
        */

        $ordersQuery = Order::whereBetween(
            'created_at',
            [$startDate, $endDate]
        );

        $totalOrders = (clone $ordersQuery)->count();

        $deliveredOrders = (clone $ordersQuery)
            ->where('order_status', 'delivered')
            ->count();

        $pendingOrders = (clone $ordersQuery)
            ->where('order_status', 'pending')
            ->count();

        $cancelledOrders = (clone $ordersQuery)
            ->where('order_status', 'cancelled')
            ->count();

        /*
        |--------------------------------------------------------------------------
        | Revenue
        |--------------------------------------------------------------------------
        */

        $totalRevenue = (clone $ordersQuery)
            ->where('order_status', 'delivered')
            ->sum('total_price');

        $booksSold = (clone $ordersQuery)
            ->where('order_status', 'delivered')
            ->sum('quantity');

        $averageOrderValue = $deliveredOrders > 0
            ? $totalRevenue / $deliveredOrders
            : 0;

        /*
        |--------------------------------------------------------------------------
        | Users
        |--------------------------------------------------------------------------
        */

        $newUsers = User::whereBetween(
            'created_at',
            [$startDate, $endDate]
        )->count();

        /*
        |--------------------------------------------------------------------------
        | Books
        |--------------------------------------------------------------------------
        */

        $totalBooks = Book::count();

        $lowStockBooks = Book::where('stock', '<=', 5)->count();

        $outOfStockBooks = Book::where('stock', 0)->count();

        /*
        |--------------------------------------------------------------------------
        | Revenue By Day
        |--------------------------------------------------------------------------
        */

        $revenueByDay = Order::query()
            ->selectRaw(
                'DATE(created_at) as date, SUM(total_price) as revenue'
            )
            ->where('order_status', 'delivered')
            ->whereBetween('created_at', [$startDate, $endDate])
            ->groupByRaw('DATE(created_at)')
            ->orderBy('date')
            ->get();

        /*
        |--------------------------------------------------------------------------
        | Orders By Status
        |--------------------------------------------------------------------------
        */

        $ordersByStatus = Order::query()
            ->selectRaw('order_status, COUNT(*) as total')
            ->whereBetween('created_at', [$startDate, $endDate])
            ->groupBy('order_status')
            ->orderByDesc('total')
            ->get();

        /*
        |--------------------------------------------------------------------------
        | Top Selling Books
        |--------------------------------------------------------------------------
        */

        $topBooks = Order::query()
            ->selectRaw(
                'book_id, SUM(quantity) as total_sold, SUM(total_price) as revenue'
            )
            ->with('book')
            ->where('order_status', 'delivered')
            ->whereBetween('created_at', [$startDate, $endDate])
            ->groupBy('book_id')
            ->orderByDesc('total_sold')
            ->limit(10)
            ->get();

        /*
        |--------------------------------------------------------------------------
        | Recent Orders
        |--------------------------------------------------------------------------
        */

        $recentOrders = Order::with(['user', 'book'])
            ->whereBetween('created_at', [$startDate, $endDate])
            ->latest()
            ->limit(10)
            ->get();

        /*
        |--------------------------------------------------------------------------
        | Return Analytics Dashboard
        |--------------------------------------------------------------------------
        */

        return view('admin.analytics.index', compact(
            'startDate',
            'endDate',
            'totalOrders',
            'deliveredOrders',
            'pendingOrders',
            'cancelledOrders',
            'totalRevenue',
            'booksSold',
            'averageOrderValue',
            'newUsers',
            'totalBooks',
            'lowStockBooks',
            'outOfStockBooks',
            'revenueByDay',
            'ordersByStatus',
            'topBooks',
            'recentOrders'
        ));
    }
}