<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $fillable = [
        'stripeID',
        'email',
        'first_name',
        'last_name',
        'id'
    ];

    public function setFirstNameAttribute($first_name)
    {
        $this->attributes['first_name'] = ucfirst($first_name);
    }

    public function setLastNameAttribute($last_name)
    {
        $this->attributes['last_name'] = ucfirst($last_name);
    }

    public function getPartecipation() {
        $count = Event::all()->count();
        $tickets = $this->ticket()->where('expired', true)->get();

        $partecipated = [];


        foreach($tickets as $ticket) {
            $event = $ticket->event()->first();

            if ( !array_key_exists($event->name, $partecipated) ) {
                $name = $event->name;
                $partecipated["$name"] = $name;
            }
        }

        $pcount = count($partecipated);

        $level = ( $pcount * 100 ) / $count;

        return round($level, 2);
    }

    public function scopeFilter($query, $filters)
    {
        if (count($filters)) {
            if (isset($filters['email']) && $email = $filters['email']) {
                return $query->where('email', $email);
            }

            if (isset($filters['first_name']) && $first_name = $filters['first_name']) {
                return $query->where('first_name', $first_name);
            }

            if (isset($filters['last_name']) && $last_name = $filters['last_name']) {
                return $query->where('last_name', $last_name);
            }

            if (isset($filters['tickets']) && $tickets = $filters['tickets']) {
                return $query->where('tickets', $tickets);
            }
        }

        return false;
    }

    public function ticket()
    {
        return $this->hasMany('App\Ticket', 'email', 'email');
    }
}
