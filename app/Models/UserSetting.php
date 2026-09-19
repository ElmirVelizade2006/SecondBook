<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserSetting extends Model
{
    protected $fillable = [
        'user_id',
        'email_notifications',
        'order_updates',
        'promotional_emails',
        'profile_visible',
    ];

    protected $casts = [
        'email_notifications' => 'boolean',
        'order_updates' => 'boolean',
        'promotional_emails' => 'boolean',
        'profile_visible' => 'boolean',
    ];

    /**
     * User relation.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}