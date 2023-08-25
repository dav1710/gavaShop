<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShoesSize extends Model
{
    protected $guarded = false;

    public function product()
    {
        return $this->belongsToMany(Product::class, 'shoes_size_products');
    }
}