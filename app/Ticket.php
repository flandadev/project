<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Event;

class Ticket extends Model
{
    protected $dates = ['expiration'];
    protected $fillable  = [
        'event',
        'email',
        'value',
        'hasBus',
        'busType',
        'expiration',
        'expired'
    ];


    // Setup relations
    public function customer()
    {
        return $this->belongsTo('App\Customer', 'email', 'email');
    }

    public function event() {
        return $this->belongsTo('App\Event', 'event_token', 'event_token');
    }


    public function setExpirationAttribute($expiration)
    {
        return $this->attributes['expiration'] = Carbon::parse($expiration);
    }

}
