<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [

        // Order Information
        'order_number',

        // Relations
        'user_id',
        'book_id',

        // Price
        'book_price',
        'quantity',
        'total_price',

        // Payment
        'payment_method',
        'payment_status',

        // Order Status
        'order_status',

        // Shipping
        'full_name',
        'phone',
        'country',
        'city',
        'postal_code',
        'address',

        // Extra
        'note',

    ];

    protected $casts = [

        'book_price' => 'decimal:2',
        'total_price' => 'decimal:2',

    ];

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function book()
    {
        return $this->belongsTo(Book::class);
    }

    public function payment()
    {
        return $this->hasOne(Payment::class);
    }

}