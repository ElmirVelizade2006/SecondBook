<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    protected $fillable = [
        'title',
        'subtitle',
        'image',
        'button_text',
        'button_url',
        'position',
        'status',
        'start_date',
        'end_date',
    ];

    protected $casts = [
        'position' => 'integer',
        'start_date' => 'date',
        'end_date' => 'date',
    ];
}