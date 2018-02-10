<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BusLine extends Model
{
    protected $fillable = [
        "price",
        "origin"
    ];

    protected function setPriceAttribute($price)
    {
        $this->attributes['price'] = $price + 0;
    }
}
