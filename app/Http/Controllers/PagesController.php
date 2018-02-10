<?php

namespace App\Http\Controllers;

use \App\Event;
use \App\BusLine;

class PagesController extends Controller
{
    public function index()
    {
        $events = Event::latest('event_date')->get();
        $latestEvent = Event::latest('event_date')->first();
        return view('static.index', compact('events', 'latestEvent'));
    }

    public function checkout($id)
    {
        $event = Event::where('event_token', $id)->firstOrFail();
        $lines = BusLine::all()->toArray();

        if (count($event)) {
            return view('static.subscribe', compact('event', 'lines'));
        }

        return redirect()->back()->withInput();
    }
}
