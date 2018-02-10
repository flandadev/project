<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Balance extends Model
{
    protected $fillable = [
        "total"
    ];

    public function setTotalAttribute($tot) {
        $this->attributes['total'] = $tot + 0;
    }
}
