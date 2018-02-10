@extends('layouts.master', ['title' => 'Checkout: ' . $event->name])
 @section('styles')
     {!! Html::style('/css/stripe-form.min.css') !!}
     {!! Html::style('/css/checkout.min.css') !!}
 @endsection

@section('content')
    @php


        $buslines = [];
        $array = $errors->toArray();
          if (count($array)) {
            foreach($array as $key => $value) {
              $list[$key]['msg'] = $array[$key][0];
              $list[$key]['class'] = 'is-invalid';
            }
          }

        $remaining = $event->tickets - $event->sold_tickets;
        $tickets = [];

        if ($remaining > 10) {
            $remaining = 10;
        }

        for($i=1; $i <= $remaining; $i++) {
            $tickets[$i] = "$i Ticket/s";
        }

        if (!count($tickets)) {
            $tickets[] = 'SOLD OUT';
            $soldOUT = true;
        }

        foreach($lines as $line) {
            $buslines[ strtolower($line['price']) ] = $line['origin'];
        }

    $buslines[0] = 'None';
    @endphp

    @include('layouts.navbar')
    <div class="section fp center-container pattern">
      @if (session('message') && session('status'))
        <div class="alert alert-{{ session('status') }} alert-dismissible fade show flash-message" role="alert">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          {{ session('message') }}
        </div>
      @endif
	  
        {{-- /{{ $event->id }} --}}
        {!! Form::open([ 'url' => '/charge/' . $event->event_token, 'method' => 'post', 'id' => 'payment-form', 'class' => 'w-bg']) !!}

          {{-- HIDDEN INPUTS --}}
          {!! Form::hidden('event-token', $event->event_token) !!}
          {!! Form::hidden('event-price', $event->price) !!}
          {!! Form::hidden('event-bus', 0) !!}
          {!! Form::hidden('stripe-key', env('STRIPE_KEY')) !!}

          {{-- NON HIDDEN --}}
          <div class="form-row">
            <div class="col form-group">
              {!! Form::label('first_name', 'First Name:', ['class' => 'form-label']) !!}
              @if (isset($list['first_name']))
                {!! Form::text('first_name', null, ['class' => 'form-control is-invalid', 'placeholder' => 'John', 'disabled' => isset($soldOUT) ? true : false]) !!}
                <div class="invalid-feedback">
                  {{ $list['first_name']['msg'] }}
                </div>
              @else
                {!! Form::text('first_name', null, ['class' => 'form-control', 'placeholder' => 'John', 'disabled' => isset($soldOUT) ? true : false]) !!}
              @endif
            </div>
            <div class="col form-group">
              {!! Form::label('last_name', 'Last Name:', ['class' => 'form-label']) !!}
              @if (isset($list['last_name']))
                {!! Form::text('last_name', null, ['class' => 'form-control is-invalid', 'placeholder' => 'Doe', 'disabled' => isset($soldOUT) ? true : false]) !!}
                <div class="invalid-feedback">
                  {{ $list['last_name']['msg'] }}
                </div>
              @else
                {!! Form::text('last_name', null, ['class' => 'form-control', 'placeholder' => 'Doe', 'disabled' => isset($soldOUT) ? true : false]) !!}
              @endif
            </div>
          </div>
          <div class="form-group">
            {!! Form::label('email', 'Email:', ['class' => 'form-label']) !!}
            @if (isset($list['email']))
              {!! Form::email('email', null, ['class' => 'form-control is-invalid', 'placeholder' => 'jdoe@example.me', 'disabled' => isset($soldOUT) ? true : false]) !!}
              <div class="invalid-feedback">
                {{ $list['email']['msg'] }}
              </div>
            @else
              {!! Form::email('email', null, ['class' => 'form-control', 'placeholder' => 'jdoe@example.me', 'disabled' => isset($soldOUT) ? true : false]) !!}
              <small class="text-muted">Be sure to insert a valid email address. We will send tickets to this address.</small>
            @endif
          </div>
          <div class="form-row">
            <div class="col form-group">
              {!! Form::label('bus', 'Pick a bus:', ['class' => 'form-label']) !!}
              {!! Form::select('bus', $buslines, 'no-bus', ['class' => 'form-control', 'required' => 'true', 'disabled' => isset($soldOUT) ? true : false]) !!}
            </div>
            <div class="col form-group">
              {!! Form::label('ticket', 'How many people?', ['class' => 'form-label']) !!}
              {!! Form::select('ticket', $tickets, 1, ['class' => 'form-control', 'disabled' => isset($soldOUT) ? true : false]) !!}
            </div>
          </div>
          <div class="form-group">
                <label for="card-element">
                  Credit or debit card
                </label>
                <div id="card-element">
                  {{-- a Stripe Element will be inserted here. --}}
                </div>

                {{-- Used to display form errors --}}
                <div id="card-errors" role="alert"></div>
              	<small class="text-muted" role="alert">If you get a page full of code, DO NOT RELOAD, YOUR PAYMENT HAS BEEN ACCEPTED!</small>
            </div>

			@if(!isset($soldOUT))
            	<button type="submit" style="cursor: pointer" class="btn btn-primary"> Pay </button>
			@else
            	<button disabled type="button" style="cursor: pointer" class="btn btn-secondary"> 
					SOLD OUT
				</button>			
			@endif
        {!! Form::close() !!}
    </div>

        @php
          if (session('pdfData')) {
            $data = session('pdfData');

            $tickets = $data['tickets'];
            $user = $data['user'];
            $event = $data['event'];
          }
        @endphp
@endsection
@section('scripts')
    {{ Html::script('https://js.stripe.com/v3/') }}
    {{ Html::script('/js/stripe-card.js') }}
    {!! Html::script('/js/checkout.js') !!}
@endsection
