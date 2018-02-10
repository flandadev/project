@extends('layouts.master', ['title' => 'Admin - Password Reset', 'isAdmin' => 'true', 'fixed' => 'true'])
@section('content')
    @if ( session('message') )
        <div class="alert alert-{{ session('class')  }}">
            {!! session('message') !!}
        </div>
    @endif

    @php
        $list = [];
        foreach($events->toArray() as $event) {
            $list[ $event['event_token'] ] = $event['name'];
        }
    @endphp

    <div class="section fp center-container">
        {!! Form::open([ 'url' => '/admin/customers',  'method' => 'POST']) !!}

        {{-- NON HIDDEN --}}
        <div class="form-row">
            <div class="col form-group">
                {!! Form::label('first_name', 'First Name:', ['class' => 'form-label']) !!}
                @if (isset($list['first_name']))
                    {!! Form::text('first_name', null, ['class' => 'form-control is-invalid', 'placeholder' => 'John', 'required']) !!}
                    <div class="invalid-feedback">
                        {{ $list['first_name']['msg'] }}
                    </div>
                @else
                    {!! Form::text('first_name', null, ['class' => 'form-control', 'placeholder' => 'John', 'required']) !!}
                @endif
            </div>
            <div class="col form-group">
                {!! Form::label('last_name', 'Last Name:', ['class' => 'form-label']) !!}
                @if (isset($list['last_name']))
                    {!! Form::text('last_name', null, ['class' => 'form-control is-invalid', 'placeholder' => 'Doe', 'required']) !!}
                    <div class="invalid-feedback">
                        {{ $list['last_name']['msg'] }}
                    </div>
                @else
                    {!! Form::text('last_name', null, ['class' => 'form-control', 'placeholder' => 'Doe', 'required']) !!}
                @endif
            </div>
        </div>
        <div class="form-group">
            {!! Form::label('email', 'Email:', ['class' => 'form-label']) !!}
            @if (isset($list['email']))
                {!! Form::email('email', null, ['class' => 'form-control is-invalid', 'placeholder' => 'jdoe@example.me', 'required']) !!}
                <div class="invalid-feedback">
                    {{ $list['email']['msg'] }}
                </div>
            @else
                {!! Form::email('email', null, ['class' => 'form-control', 'placeholder' => 'jdoe@example.me', 'required']) !!}
                <small class="text-muted">
                    Be sure to insert a valid email address. We will send tickets to this address.
                </small>
            @endif
        </div>
        <div class="form-row">
            <div class="col form-group">
                {!! Form::label('bus', 'Bus type:', ['class' => 'form-label']) !!}
                {!! Form::select('bus', [
                    'Bus Services' => [
                      'segovia-bus' => 'Bus from Segovia',
                      'madrid-bus' => 'Bus from Madrid'
                    ],
                    'no-bus' => 'None'
                  ], 'no-bus', ['class' => 'form-control', 'required' => 'true']) !!}
            </div>
            <div class="col form-group">
                {!! Form::label('tickets', 'Quantity:', ['class' => 'form-label']) !!}
                {!! Form::select('tickets', [
                    1 => '1 Ticket',
                    2 => '2 Tickets',
                    3 => '3 Tickets',
                    4 => '4 Tickets',
                    5 => '5 Tickets',
                    6 => '6 Tickets',
                    7 => '7 Tickets',
                    8 => '8 Tickets',
                    9 => '9 Tickets',
                    10 => '10 Tickets'
                  ], 1, ['class' => 'form-control', 'required']) !!}
            </div>
        </div>

        <div class="form-group">
            {!! Form::label('event', 'Select an event') !!}
			@if (count($list)) 
	            {!! Form::select('event_token', $list, 0, ['class' => 'form-control', 'required']) !!}
			@else
				<select name="event_token" id="event_token" class="form-control" required>
					<option value="none" disabled selected>No events availables</option>
				</select>
			@endif			
        </div>

        <button type="submit" style="cursor: pointer" class="btn btn-dark"> Create New </button>
        {!! Form::close() !!}
    </div>
@endsection