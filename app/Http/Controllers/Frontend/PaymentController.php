<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Exception;

class PaymentController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Payment Page
    |--------------------------------------------------------------------------
    */

    public function show(Order $order)
    {
        /*
        |--------------------------------------------------------------------------
        | Make sure this order belongs to the logged-in user
        |--------------------------------------------------------------------------
        */

        if ($order->user_id !== auth()->id()) {
            abort(403);
        }

        /*
        |--------------------------------------------------------------------------
        | Get Payment
        |--------------------------------------------------------------------------
        */

        $payment = Payment::where('order_id', $order->id)
            ->latest()
            ->first();

        /*
        |--------------------------------------------------------------------------
        | Payment must exist
        |--------------------------------------------------------------------------
        */

        if (!$payment) {
            return redirect()
                ->route('frontend.orders')
                ->with(
                    'error',
                    'Payment information was not found for this order.'
                );
        }

        /*
        |--------------------------------------------------------------------------
        | Already Paid
        |--------------------------------------------------------------------------
        */

        if ($payment->payment_status === 'paid') {
            return redirect()
                ->route('frontend.orders')
                ->with(
                    'success',
                    'This order has already been paid.'
                );
        }

        /*
        |--------------------------------------------------------------------------
        | Show Payment Page
        |--------------------------------------------------------------------------
        */

        return view(
            'Frontend.payment',
            compact('order', 'payment')
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Process Payment
    |--------------------------------------------------------------------------
    */

    public function process(Request $request, Order $order)
    {
        /*
        |--------------------------------------------------------------------------
        | Make sure this order belongs to the logged-in user
        |--------------------------------------------------------------------------
        */

        if ($order->user_id !== auth()->id()) {
            abort(403);
        }

        /*
        |--------------------------------------------------------------------------
        | Get Payment
        |--------------------------------------------------------------------------
        */

        $payment = Payment::where('order_id', $order->id)
            ->latest()
            ->first();

        /*
        |--------------------------------------------------------------------------
        | Payment must exist
        |--------------------------------------------------------------------------
        */

        if (!$payment) {
            return redirect()
                ->route('frontend.orders')
                ->with(
                    'error',
                    'Payment information was not found for this order.'
                );
        }

        /*
        |--------------------------------------------------------------------------
        | Prevent Duplicate Payment
        |--------------------------------------------------------------------------
        */

        if ($payment->payment_status === 'paid') {
            return redirect()
                ->route('frontend.orders')
                ->with(
                    'success',
                    'This order has already been paid.'
                );
        }


        /*
        |--------------------------------------------------------------------------
        | Validate Payment Method
        |--------------------------------------------------------------------------
        */

        $validated = $request->validate([
            'payment_method' => [
                'required',
                'in:credit_card,debit_card,paypal,cash_on_delivery',
            ],
        ]);


        /*
        |--------------------------------------------------------------------------
        | Validate According To Payment Method
        |--------------------------------------------------------------------------
        */

        if (
            in_array(
                $validated['payment_method'],
                ['credit_card', 'debit_card']
            )
        ) {

            $request->validate([
                'cardholder_name' => [
                    'required',
                    'string',
                    'max:255',
                ],

                'card_number' => [
                    'required',
                    'string',
                    'regex:/^[0-9\s-]{13,23}$/',
                ],

                'expiry_date' => [
                    'required',
                    'string',
                    'regex:/^(0[1-9]|1[0-2])\s?\/\s?[0-9]{2}$/',
                ],

                'cvv' => [
                    'required',
                    'string',
                    'regex:/^[0-9]{3,4}$/',
                ],
            ]);

        }


        /*
        |--------------------------------------------------------------------------
        | Validate PayPal
        |--------------------------------------------------------------------------
        */

        if ($validated['payment_method'] === 'paypal') {

            $request->validate([
                'paypal_email' => [
                    'required',
                    'email',
                    'max:255',
                ],
            ]);

        }


        /*
        |--------------------------------------------------------------------------
        | Cash On Delivery
        |--------------------------------------------------------------------------
        |
        | No card or PayPal information is required.
        |
        |--------------------------------------------------------------------------
        */


        /*
        |--------------------------------------------------------------------------
        | Process Payment
        |--------------------------------------------------------------------------
        */

        try {

            DB::transaction(function () use (
                $payment,
                $order,
                $validated
            ) {

                /*
                |--------------------------------------------------------------------------
                | Lock Payment
                |--------------------------------------------------------------------------
                */

                $payment = Payment::whereKey($payment->id)
                    ->lockForUpdate()
                    ->first();

                if (!$payment) {
                    throw new Exception(
                        'Payment could not be found.'
                    );
                }


                /*
                |--------------------------------------------------------------------------
                | Prevent Duplicate Payment
                |--------------------------------------------------------------------------
                */

                if ($payment->payment_status === 'paid') {
                    throw new Exception(
                        'This order has already been paid.'
                    );
                }


                /*
                |--------------------------------------------------------------------------
                | Update Payment
                |--------------------------------------------------------------------------
                */

                $payment->update([
                    'payment_method' => $validated['payment_method'],
                    'payment_status' => 'paid',
                    'paid_at' => now(),
                    'note' => $this->getPaymentNote(
                        $validated['payment_method']
                    ),
                ]);


                /*
                |--------------------------------------------------------------------------
                | Update Order Payment Status
                |--------------------------------------------------------------------------
                */

                $order->update([
                    'payment_method' => $validated['payment_method'],
                    'payment_status' => 'paid',
                ]);

            });


            /*
            |--------------------------------------------------------------------------
            | Payment Successful
            |--------------------------------------------------------------------------
            */

            return redirect()
                ->route('frontend.orders')
                ->with(
                    'success',
                    'Payment completed successfully. Your order has been confirmed.'
                );

        } catch (Exception $e) {

            return back()
                ->withInput()
                ->with(
                    'error',
                    $e->getMessage()
                );
        }
    }


    /*
    |--------------------------------------------------------------------------
    | Payment Note
    |--------------------------------------------------------------------------
    */

    private function getPaymentNote(string $paymentMethod): string
    {
        return match ($paymentMethod) {

            'credit_card' =>
                'Payment completed successfully using credit card.',

            'debit_card' =>
                'Payment completed successfully using debit card.',

            'paypal' =>
                'Payment completed successfully using PayPal.',

            'cash_on_delivery' =>
                'Order confirmed with cash on delivery.',

            default =>
                'Payment completed successfully.',
        };
    }
}

