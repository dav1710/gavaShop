<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';
    protected $fillable = [
        'title', 'description', 'content', 'price', 'count', 'images', 'is_published', 'category_id'
    ];
    protected $casts = [
        'images' => 'array'
    ];

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'product_tags', 'product_id', 'tag_id');
    }

    public function shoes_size()
    {
        return $this->belongsToMany(ShoesSizeProduct::class, 'shoes_size_products', 'product_id', 'shoes_sizes_id');
    }

    public function colors()
    {
        return $this->belongsToMany(Color::class, 'color_products', 'product_id', 'color_id');
    }
}
