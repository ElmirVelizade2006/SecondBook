<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [

        'name',
        'first_name',
        'last_name',
        'username',

        'email',
        'password',

        'role',

        'phone',
        'profile_photo',

        'date_of_birth',
        'gender',

        'country',
        'city',
        'state',
        'postal_code',
        'address',

        'bio',

        'receive_email_notifications',
        'receive_order_updates',
        'receive_promotional_emails',
        'profile_visibility',

        'last_login_at',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [

        'email_verified_at' => 'datetime',

        'password' => 'hashed',

        'date_of_birth' => 'date',

        'last_login_at' => 'datetime',

        'receive_email_notifications' => 'boolean',
        'receive_order_updates' => 'boolean',
        'receive_promotional_emails' => 'boolean',
        'profile_visibility' => 'boolean',
    ];

    /*
    |--------------------------------------------------------------------------
    | Accessors
    |--------------------------------------------------------------------------
    */

    public function getFullNameAttribute(): string
    {
        return trim($this->first_name . ' ' . $this->last_name);
    }

    /*
    |--------------------------------------------------------------------------
    | Helpers
    |--------------------------------------------------------------------------
    */

    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    public function isUser(): bool
    {
        return $this->role === 'user';
    }
}