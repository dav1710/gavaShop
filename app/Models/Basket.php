<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Basket extends Model
{
    protected $guarded = false;

    public function products() {
        return $this->belongsToMany(Product::class)->withPivot('quantity');
    }
}
