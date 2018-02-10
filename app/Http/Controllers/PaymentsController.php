<?php
// In this controller we do the strong part of this website
// We can manage tickets, create new tickets and much more ...
// - Retrive payments
// - Control on new Tickets
// - Control on new Customers


namespace App\Http\Controllers;

use App\Balance;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Stripe\Charge as StripeCharge;
use Stripe\Customer as StripeCustomer;

use App\Ticket;
use App\Event;
use App\Customer;
use App\Mail\Invoice;
use App\BusLine;

#Tickets
class PaymentsController extends Controller
{
    public function store($event_token, Request $request)
    {
        if ($event_token != request('event-token')) {
            return redirect()->back()->withInput();
        }


        $request->validate([
            'first_name' => 'required|min:2',
            'last_name' => 'required|min:2',
            'email' => 'required|email',
            'event-token' => 'required',
            'bus' => 'required',
            'ticket' => 'required',
            'stripeToken' => 'required'
        ]);


        $event = Event::where('event_token', request('event-token'))->firstOrFail();
        $remainingTickets = $event->tickets - $event->sold_tickets;

        $bus = BusLine::where('origin', $request->bus)->get();
        $count = ( request('ticket')+0 >= 1 ) ? request('ticket')+0 : 1;
        $extra = 0;

        if ($remainingTickets < $request->ticket) {
            session()->flash('status', 'danger');
            session()->flash('message', 'OOOPS! It\'s seems that we are officially sold out. Sorry, se you next time!');
            return redirect()->back()->withInput();
        }

        // ADD THE TAX
        $price = ($event->price + $bus->price) * $count;


        // Generate new user if not exists
        $exists = Customer::where('email', request('email'))->first();

        // if the user doesn't exists then create a new customer
        if (!count($exists)) {
            // Create the customer
            $customer = StripeCustomer::create([
                'email' => request('email'),
                'source' => request('stripeToken')
            ]);

            // Charge the card
            $charge = StripeCharge::create([
                'customer' => $customer->id,
                'amount' => $price,
                'currency' => 'eur'
            ]);

            $user = Customer::create([
                'first_name' => request('first_name'),
                'last_name' => request('last_name'),
                'email' => request('email'),
                'stripeID' => $customer->id,
                'tickets' => request('ticket')
            ]);
        } else {
            // else grab the user stripeID and charge the card
            // Charge the card
            $charge = StripeCharge::create([
                'customer' => $exists->stripeID,
                'amount' => $price,
                'currency' => 'eur',
                'description' => $event->name . ' Ticket'
            ]);

            $user = $exists;

            $tickets = $user->tickets;
            $user->tickets = $tickets + request('ticket');

            $user->save();
        }

        $total = Balance::where('name', 'total')->where('token', false)->first();
        $thisEvent = Balance::where('token', $event->event_token)->first();

        if ($total) {
            $total->value += $price;
            $total->saveOrFail();
        }

        if ($thisEvent) {
            $thisEvent->value += $price;
            $thisEvent->saveOrFail();
        }


        // Start tickets setup.
        // Add to sold tickets tickets
        $event->sold_tickets += $count;
        $event->save();

        // if charge success
        if ($charge->status == 'succeeded') {
            // generate new response
            session()->flash('message', 'Thanks for your purchase! Check your inbox to get the tickets');
            session()->flash('status', 'success');

            // generate tickets
            $generatedTickets = $this->generateTickets($count);
            $tickets = [];
            
            if (count($generatedTickets) === 1 && !is_array($generatedTickets) && !is_object($generatedTickets)) {
                // if the ticket is only one
                $newTicket = $generatedTickets;

                // Create new ticket foreach ticket that the user has payed.
                $ticket = new Ticket;
                $ticket->customer_id = $user->id;
                $ticket->event_token = $event->event_token;
                $ticket->email = $user->email;
                $ticket->value = $newTicket;
                $ticket->expiration = $event->event_date;
                $ticket->expired = false;
                $ticket->hasBus = ($extra != 0);
                $ticket->busType = $bus;
                $ticket->save();

                // Grab it
                $ticket = $ticket->where('value', $newTicket)->first()->toArray();

                // Put into the `tickets` array
                $tickets[] = $ticket;
            } elseif (count($generatedTickets > 1)) {
                foreach ($generatedTickets as $newTicket) {
                    // WARNING: method 'Ticket::create' gives undefined 'user_newsletter_id'
                    // Create new ticket foreach ticket that the user has payed.
                    $ticket = new Ticket;
                    $ticket->customer_id = $user->id;
                    $ticket->event_token = $event->event_token;
                    $ticket->email = $user->email;
                    $ticket->value = $newTicket;
                    $ticket->expiration = $event->event_date;
                    $ticket->expired = false;
                    $ticket->hasBus = ($extra != 0);
                    $ticket->busType = $bus;
                    $ticket->save();
    
                    // Grab it
                    $ticket = $ticket->where('value', $newTicket)->first()->toArray();
    
                    // Put into the `tickets` array
                    $tickets[] = $ticket;
                }
            }
                        

            // redirect back the user with session message.
            // Send tickets & return a recepit.

            \PDF::setOptions(['dpi' => 150, 'defaultFont' => 'Helvetica, sans-serif']);
            $pdf = \App::make('dompdf.wrapper');
            $pdf->loadView('emails.ticket', compact('tickets', 'user', 'event'));
            $file = $pdf->output();

            \Mail::to($user)->send(new Invoice(compact('tickets', 'user', 'event', 'file')));

            return redirect()->back();
        }

        // Hey man! Something went wrong with your card!
        session()->flash('message', 'Hey man! Something went wrong with your card.. Check it and come back later!');
        session()->flash('status', 'danger');
        return redirect()->back()->withInput();
    }
}
