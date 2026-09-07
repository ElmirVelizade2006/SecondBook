<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable = [

    'title',
    'isbn',
    'category_id',
    'author_id',
    'publisher_id',
    'seller_id',
    'description',
    'cover',
    'publication_year',
    'pages',
    'language',
    'price',
    'stock',
    'condition',
    'status',

];

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function author()
    {
        return $this->belongsTo(Author::class);
    }

    public function publisher()
    {
        return $this->belongsTo(Publisher::class);
    }

    public function seller()
    {
        return $this->belongsTo(User::class, 'seller_id');
    }
}