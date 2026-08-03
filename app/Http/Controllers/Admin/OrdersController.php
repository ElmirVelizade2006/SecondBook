<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Book;
use App\Models\User;
use Illuminate\Http\Request;

class OrdersController extends Controller
{

    /**
     * Display a listing of orders.
     */
    public function index()
    {
        $orders = Order::with(['user', 'book'])
            ->latest()
            ->paginate(10);

        return view('admin.orders.index', compact('orders'));
    }



    /**
     * Show create order page.
     */
    public function create()
    {
        $users = User::orderBy('first_name')->get();
        $books = Book::orderBy('title')->get();

        return view('admin.orders.create', compact('users', 'books'));
    }




    /**
     * Store new order.
     */
    public function store(Request $request)
    {
        $request->validate([

            'user_id' => 'required|exists:users,id',
            'book_id' => 'required|exists:books,id',

            'book_price' => 'required|numeric',
            'quantity' => 'required|integer|min:1',

            'payment_method' => 'required',
            'payment_status' => 'required',
            'order_status' => 'required',

            'full_name' => 'required',
            'phone' => 'required',
            'country' => 'required',
            'city' => 'required',
            'address' => 'required',

        ]);


        Order::create([

            'order_number' => 'ORD-'.time(),

            'user_id' => $request->user_id,
            'book_id' => $request->book_id,

            'book_price' => $request->book_price,
            'quantity' => $request->quantity,

            'total_price' => $request->book_price * $request->quantity,


            'payment_method' => $request->payment_method,
            'payment_status' => $request->payment_status,

            'order_status' => $request->order_status,


            'full_name' => $request->full_name,
            'phone' => $request->phone,

            'country' => $request->country,
            'city' => $request->city,

            'postal_code' => $request->postal_code,

            'address' => $request->address,

            'note' => $request->note,

        ]);


        return redirect()
            ->route('admin.orders.index')
            ->with('success','Order created successfully.');
    }





    /**
     * Display order details.
     */
    public function show(Order $order)
    {

        $order->load([
            'user',
            'book'
        ]);


        return view('admin.orders.show', compact('order'));

    }





    /**
     * Edit order page.
     */
    public function edit(Order $order)
    {

        $users = User::orderBy('first_name')->get();

        $books = Book::orderBy('title')->get();


        return view('admin.orders.edit', compact(
            'order',
            'users',
            'books'
        ));

    }





    /**
     * Update order.
     */
    public function update(Request $request, Order $order)
    {

        $request->validate([

            'user_id' => 'required|exists:users,id',

            'book_id' => 'required|exists:books,id',

            'book_price' => 'required|numeric|min:0',

            'quantity' => 'required|integer|min:1',

            'payment_method' => 'required',

            'payment_status' => 'required',

            'order_status' => 'required',

            'full_name' => 'required|string',

            'phone' => 'required|string',

            'country' => 'required|string',

            'city' => 'required|string',

            'postal_code' => 'nullable|string',

            'address' => 'required|string',

            'note' => 'nullable|string',

        ]);



        $order->update([

            'user_id' => $request->user_id,

            'book_id' => $request->book_id,

            'book_price' => $request->book_price,

            'quantity' => $request->quantity,

            'total_price' => $request->book_price * $request->quantity,


            'payment_method' => $request->payment_method,

            'payment_status' => $request->payment_status,

            'order_status' => $request->order_status,


            'full_name' => $request->full_name,

            'phone' => $request->phone,

            'country' => $request->country,

            'city' => $request->city,

            'postal_code' => $request->postal_code,

            'address' => $request->address,

            'note' => $request->note,

        ]);



        return redirect()

            ->route('admin.orders.index')

            ->with('success','Order updated successfully.');

    }





    /**
     * Delete order.
     */
    public function destroy(Order $order)
    {

        $order->delete();


        return redirect()

            ->route('admin.orders.index')

            ->with('success','Order deleted successfully.');

    }

}