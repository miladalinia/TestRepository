<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'user_id', 'name', 'author',
        'publisher', 'publish_year',
        'product_code', 'type',
        'category', 'weight', 'price',
        'image',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
