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
    protected $table = 'products';
    public $timestamps = true;

    protected $touches = ['user'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
