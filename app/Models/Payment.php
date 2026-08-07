<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [

        'transaction_id',
        'order_id',
        'amount',
        'payment_method',
        'payment_status',
        'paid_at',
        'note',

    ];

    protected $casts = [

        'amount' => 'decimal:2',
        'paid_at' => 'datetime',

    ];

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}