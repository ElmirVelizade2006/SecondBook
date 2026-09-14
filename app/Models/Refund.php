<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Refund extends Model
{
    protected $fillable = [
        'order_id', 'payment_id', 'user_id', 'processed_by', 'refund_number',
        'amount', 'reason', 'note', 'status', 'requested_at', 'processed_at',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'requested_at' => 'datetime',
        'processed_at' => 'datetime',
    ];

    public function order() { return $this->belongsTo(Order::class); }
    public function payment() { return $this->belongsTo(Payment::class); }
    public function user() { return $this->belongsTo(User::class); }
    public function processor() { return $this->belongsTo(User::class, 'processed_by'); }
}
