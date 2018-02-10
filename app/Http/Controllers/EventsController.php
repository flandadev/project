<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Event;
use App\Balance;
use App\Ticket;
use App\Customer;

class EventsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    # get           events                  -> index
    public function index()
    {
        $events = Event::all();
        return view('admin.events.list', compact('events'));
    }

    # get           events/{id}             -> show
    public function show($id)
    {
        $event = Event::where('event_token', $id)->firstOrFail();
        return view('admin.events.show', compact('event'));
    }

    # get           events/create           -> create
    public function create()
    {
        return view('admin.events.create');
    }

    # post          events/                 -> store
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'descr' => 'required',
            'flyer' => 'required',
            'event_token' => 'required',
            'price' => 'required',
            'event_date' => 'required',
            'av_tickets' => 'required'
        ]);

        $av_tickets = request('av_tickets')+0;

        $event = new Event;
        $event->name = $request->name;
        $event->descr = $request->descr;
        $event->flyer = $request->flyer;
        $event->event_token = $request->event_token;
        $event->price = $request->price;
        $event->tickets = $av_tickets;
        $event->event_date = $request->event_date;
        $event->saveOrFail();

        $balance = new Balance;
        $balance->name = $request->name;
        $balance->token = $request->event_token;
        $balance->saveOrFail();

        session()->flash('status', true);
        return redirect()->to('/admin/events');
    }

    # delete        events/{id}             -> destroy
    public function destroy($id)
    {
        $event = Event::where('event_token', $id)->firstOrFail();
        $event->delete();

        session()->flash('message', 'Event deleted.');
        return redirect()->back();
    }

    # get           events/{id}/edit        -> edit
    public function edit($id)
    {
        $event = Event::where('event_token', $id)->firstOrFail();
        return view('admin.events.edit', compact('event'));
    }

    # put/patch     events/{id}             -> update
    public function update($id, Request $request)
    {
        $request->validate([
            'name' => 'required|min:2',
            'descr' => 'required',
            'price' => 'required|min:3',
            'event_date' => 'required'
        ]);

        $event = Event::where('event_token', $id)->firstOrFail();
        $event->name = $request->name;
        $event->descr = $request->descr;
        $event->price = $request->price;
        $event->event_date = $request->event_date;
        $event->save();

        session()->flash('message', $event->name . ' successfully updated.');
        return redirect()->to('/admin/events');
    }

    public function checkTicket($event_token, $value) {
        if ( session('type') == 'ticket' ) {
            $ticket = Ticket::where('event_token', $event_token)->where('expiration', '>=', date('y-m-d', time()))->where('value', $value)->where('expired', false)->firstOrFail();

            if ($ticket) {
                $ticket->expired = true;
                $ticket->save();
                $extra = '';

                if ($ticket->hasBus) {
                    $busType = explode('-', $ticket->busType)[0];

                    $extra = 'He/She also have a bus ticket from <b>' . ucfirst($busType) . '</b>';
                }

                session()->flash('class', 'success');
                session()->flash('message', 'The ticket is valid. ' . $extra);
                return redirect('admin/tickets');
            }
        } else {
            $customer = Customer::where('id', $value)->first();
            $tickets = $customer->ticket()->where('expiration', '>=', date('y-m-d', time()))->where('expired', false)->where('event_token', $event_token)->get();
            $count = $tickets->count();
            $extra = '.';
            $event = Event::where('event_token', $event_token)->first();

            $fullName = $customer->first_name . ' ' . $customer->last_name;

            if ($count > 0) {
                foreach($tickets as $ticket) {
                    $hasBus = $ticket->hasBus;
                    $busType = explode('-', $ticket->busType)[0];

                    $ticket->expired = true;
                    $ticket->save();
                }

                if ($hasBus) {
                    $extra = "with bus from $busType.";
                }

                session()->flash('class', 'success');
                session()->flash('message', "$fullName has $count tickets $extra");
                return redirect('admin/tickets');
            }

            session()->flash('message', "$fullName does not have tickets for {$event->name}");
            session()->flash('class', 'danger');
            return redirect('admin/tickets')->withInput();
        }



        session()->flash('message', 'Invalid/Expired ticket.');
        session()->flash('class', 'danger');
        return redirect('admin/tickets')->withInput();
    }

    public function post_tickets(Request $req) {
        $req->validate([
            'ticketID' => 'required',
        ]);

        $ticket = Ticket::where('value', $req->ticketID)->where('expiration', '>=', date('y-m-d', time()))->first();
        $user = Ticket::where('email', $req->ticketID)->where('expiration', '>=', date('y-m-d', time()))->first();

        if (!$ticket && $user) {
            session()->flash('type', 'email');
            return redirect('/admin/tickets/' . $user->event_token . '/' . $user->customer_id);
        }

        if ($ticket) {
            session()->flash('type', 'ticket');
            return redirect('/admin/tickets/' . $ticket->event_token . '/' . $ticket->value);
        }

        session()->flash('class', 'danger');
        session()->flash('message', 'Invalid/Expired Ticket');
        return redirect()->back()->withInput();
    }

    public function tickets() {
        return view('admin.events.check_ticket');
    }
}
