<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ActiveUser extends Model
{
    protected $fillable = [
        'ip',
        'timestamp',
        'country',
        'city'
    ];

    public function count()
    {
        return count($this->where('timestamp', date('Y-m-d h:i', time()))->get()->toArray());
    }
}
