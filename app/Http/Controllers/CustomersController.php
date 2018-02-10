<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Carbon;
use App\Event;
use App\Customer;
use App\Ticket;
use App\Balance;
use App\Mail\Invoice;
use App\Mail\ManualNotification;

class CustomersController extends Controller
{
    // Pages
    public function index()
    {
        $customers = Customer::all();
        return view('admin.customers.index', compact('customers'));
    }

    public function create()
    {
        $events = Event::where('event_date', '>=', date('y-m-d', time()))->get();

        return view('admin.customers.create', compact('events'));
    }

    public function show($id)
    {
        $customer = Customer::where('id', $id)->firstOrFail();
        return view('admin.customers.show', compact('customer'));
    }

    // Server Side
    public function store(Request $request)
    {
        request()->validate([
            'first_name' => 'required|min:2',
            'last_name' => 'required|min:2',
            'email' => 'required|email',
            'tickets' => 'required',
            'bus' => 'required',
            'event_token' => 'required'
        ]);

        $customer = Customer::where('email', $request->email)->first();

        if (!$customer) {
            $customer = new Customer;
            $customer->first_name = $request->first_name;
            $customer->last_name = $request->last_name;
            $customer->email = $request->email;
            $customer->tickets = $request->tickets;

            $customer->saveOrFail();
        }

        $user = Customer::where('email', $request->email)->first();
        $event = Event::where('event_token', $request->event_token)->firstOrFail();

        if (!$event) {
            session()->flash('message', 'Error 404: Event not found');
            session()->flash('class', 'danger');
            return redirect()->back(404)->withInput();
        }

        $tickets = [];
        $generatedTickets = $this->generateTickets($request->tickets);

        foreach ($generatedTickets as $newTicket) {
            switch ($request->bus) {
                case 'madrid-bus':
                    $extra = 700;
                    $bus = 'madrid';
                    break;
                case 'segovia-bus':
                    $extra = 500;
                    $bus = 'segovia-bus';
                    break;
                default:
                    $bus = 'no-bus';
                    $extra = 0;
                    break;
            }

            $ticket = new Ticket;
            $ticket->customer_id = $user->id;
            $ticket->event_token = $event->event_token;
            $ticket->email = $user->email;
            $ticket->value = $newTicket;
            $ticket->expiration = $event->event_date;
            $ticket->expired = false;
            $ticket->hasBus  = ($extra !== 0);
            $ticket->busType = $bus;
            $ticket->saveOrFail();
            
            $tickets[] = $ticket;
        }

        $event->tickets += count($tickets);
        $event->save();
    

        \PDF::setOptions(['dpi' => 150, 'defaultFont' => 'Helvetica, sans-serif']);

        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadView('emails.ticket', compact('tickets', 'user', 'event'));
        $file = $pdf->output();

        \Mail::to($user)->send(new Invoice(compact('tickets', 'user', 'event', 'file')));
        \Mail::to('flandateam@gmail.com')->send(new ManualNotification($user, $event));

        session()->flash('message', 'Registration completed.');
        session()->flash('class', 'success');

        return redirect('/admin/customers/create');
    }

    public function update(Request $request)
    {
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required'
        ]);

        $customer = Customer::where('email', $request->email)->get();

        if ($customer) {
            $customer->first_name = $request->first_name;
            $customer->last_name = $request->last_name;
            $customer->email = $request->email;
            $customer->saveOrFail();

            session()->flash('message', 'Registration completed.');
            session()->flash('class', 'success');

            return redirect()->back();
        }

        dd('Sorry');
        session()->flash('message', 'This user doesn\'t exists.');
        session()->flash('class', 'danger');

        return redirect()->back()->withInput();
    }

    public function destroy(Request $request)
    {
        $request->validate(['email' => 'required']);

        $customer = Customer::where('email', $request->email)->get();
        if ($customer) {
            $customer->delete();

            session()->flash('message', 'User deleted.');
            session()->flash('class', 'success');
            return redirect()->back();
        }

        session()->flash('message', 'This user doesn\'t exists.');
        session()->flash('class', 'danger');
        return redirect()->back()->withInput();
    }
}
