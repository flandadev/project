@extends('layouts.master', ['title' => 'Admin - Password Reset', 'isAdmin' => 'true', 'fixed' => 'true'])
@section('content')
    @if ( session('message') )
        <div class="alert alert-{{ session('class')  }}">
            {!! session('message') !!}
        </div>
    @endif

    <div class="section fp center-container">
        <div class="customer">
            <h2 class="customer--fullname"> {{ $customer->first_name . ' ' . $customer->last_name }} </h2>
            <h4 class="customer--email"><a href="mailto:{{ $customer->email }}">{{ $customer->email }}</a> </h4>

            <br>
            <p>
                Registered: {{ $customer->created_at->diffForHumans() }} <br>
                Tickets: {{ $customer->ticket()->get()->count() }} <br>
                Parecipation: {{ $customer->getPartecipation() }}%
            </p>

            @php
                $tickets = $customer->ticket()->get();
            @endphp

            <div class="table-responsive">
                <table class="table table-hover table-bordered">
                    <thead>
                    <th> Event </th>
                    <th> Value </th>
                    <th> Status </th>
                    <th> Expiration date </th>
                    <th> Bought on </th>
                    </thead>
                    <tbody>
 	              @foreach($tickets as $ticket)
            		@php($event = $ticket->event()->first() )
                        @if ($ticket->event()->count() >= 1) 
			<tr>
                            <td> {{ $event->name}} </td>
                            <td> {{ $ticket->value }} </td>
                            <td> {{ !$ticket->expired ? 'valid' : 'expired' }}</td>
                            <td> {{ $ticket->expiration }} </td>
                            <td> {{ $ticket->created_at }} </td>
                        </tr> 
			@endif
                    @endforeach 
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
