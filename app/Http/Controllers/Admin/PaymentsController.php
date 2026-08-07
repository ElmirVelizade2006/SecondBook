<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PaymentsController extends Controller
{
    public function index(Request $request)
    {
        $query = Payment::with([
            'order.user',
            'order.book'
        ]);

        if ($request->filled('search')) {

            $search = $request->search;

            $query->where(function ($q) use ($search) {

                $q->where('transaction_id', 'like', "%{$search}%")
                    ->orWhereHas('order', function ($orderQuery) use ($search) {

                        $orderQuery->where('order_number', 'like', "%{$search}%")
                            ->orWhereHas('user', function ($userQuery) use ($search) {

                                $userQuery->where('first_name', 'like', "%{$search}%")
                                    ->orWhere('last_name', 'like', "%{$search}%")
                                    ->orWhere('email', 'like', "%{$search}%");

                            });

                    });

            });
        }

        if ($request->filled('payment_status')) {
            $query->where('payment_status', $request->payment_status);
        }

        if ($request->filled('payment_method')) {
            $query->where('payment_method', $request->payment_method);
        }

        if ($request->filled('date')) {
            $query->whereDate('created_at', $request->date);
        }

        $payments = $query
            ->latest()
            ->paginate(10)
            ->withQueryString();

        $totalPayments = Payment::count();

        $pendingPayments = Payment::where(
            'payment_status',
            'pending'
        )->count();

        $paidPayments = Payment::where(
            'payment_status',
            'paid'
        )->count();

        $totalRevenue = Payment::where(
            'payment_status',
            'paid'
        )->sum('amount');

        return view(
            'admin.payments.index',
            compact(
                'payments',
                'totalPayments',
                'pendingPayments',
                'paidPayments',
                'totalRevenue'
            )
        );
    }

    public function create()
    {
        $orders = Order::with([
            'user',
            'book'
        ])
            ->latest()
            ->get();

        return view(
            'admin.payments.create',
            compact('orders')
        );
    }

    public function store(Request $request)
    {
        $validated = $request->validate([

            'order_id' => [
                'required',
                'exists:orders,id',
                'unique:payments,order_id',
            ],

            'amount' => [
                'required',
                'numeric',
                'min:0',
            ],

            'payment_method' => [
                'required',
                'in:cash_on_delivery,credit_card,debit_card,paypal',
            ],

            'payment_status' => [
                'required',
                'in:pending,paid,failed,refunded',
            ],

            'paid_at' => [
                'nullable',
                'date',
            ],

            'note' => [
                'nullable',
                'string',
            ],

        ]);

        /*
        |--------------------------------------------------------------------------
        | Paid At
        |--------------------------------------------------------------------------
        */

        if ($request->payment_status === 'paid') {

            $validated['paid_at'] = $request->paid_at
                ? $request->paid_at
                : now();

        } else {

            $validated['paid_at'] = null;

        }

        /*
        |--------------------------------------------------------------------------
        | Transaction ID
        |--------------------------------------------------------------------------
        */

        $validated['transaction_id'] =
            'TXN-' . strtoupper(Str::random(10));

        Payment::create($validated);

        return redirect()
            ->route('admin.payments.index')
            ->with(
                'success',
                'Payment created successfully.'
            );
    }

    public function show(Payment $payment)
    {
        $payment->load([
            'order.user',
            'order.book'
        ]);

        return view(
            'admin.payments.show',
            compact('payment')
        );
    }

    public function edit(Payment $payment)
    {
        $orders = Order::with([
            'user',
            'book'
        ])
            ->latest()
            ->get();

        return view(
            'admin.payments.edit',
            compact(
                'payment',
                'orders'
            )
        );
    }

    public function update(
        Request $request,
        Payment $payment
    ) {
        $validated = $request->validate([

            'order_id' => [
                'required',
                'exists:orders,id',
                'unique:payments,order_id,' . $payment->id,
            ],

            'amount' => [
                'required',
                'numeric',
                'min:0',
            ],

            'payment_method' => [
                'required',
                'in:cash_on_delivery,credit_card,debit_card,paypal',
            ],

            'payment_status' => [
                'required',
                'in:pending,paid,failed,refunded',
            ],

            'paid_at' => [
                'nullable',
                'date',
            ],

            'note' => [
                'nullable',
                'string',
            ],

        ]);

        /*
        |--------------------------------------------------------------------------
        | Paid At
        |--------------------------------------------------------------------------
        */

        if ($request->payment_status === 'paid') {

            $validated['paid_at'] = $request->paid_at
                ? $request->paid_at
                : ($payment->paid_at ?? now());

        } else {

            $validated['paid_at'] = null;

        }

        $payment->update($validated);

        return redirect()
            ->route('admin.payments.index')
            ->with(
                'success',
                'Payment updated successfully.'
            );
    }

    public function destroy(Payment $payment)
    {
        $payment->delete();

        return redirect()
            ->route('admin.payments.index')
            ->with(
                'success',
                'Payment deleted successfully.'
            );
    }
}