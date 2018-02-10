<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use \Carbon\Carbon;

class Event extends Model
{
    protected $fillable = [
        'name',
        'descr',
        'event_date',
        'event_token',
        'event_id',
        'price',
        'flyer'
    ];

    protected $dates = ['event_date'];

    public function tickets() {
        return $this->hasMany('App\Ticket', 'event_token', 'event_token');
    }

    public function balance() {
        return $this->belongsTo('App\Balance', 'event_token', 'token');
    }

    public function scopeTitle($query, $title)
    {
        return $query->where('title', $title);
    }

    public function setEventDateAttribute($event_date)
    {
        return $this->attributes['event_date'] = Carbon::parse($event_date);
    }

    public function setEventIdAttribute($event_token)
    {
        return $this->attributes['event_token'] = sha1($event_token);
    }

}
