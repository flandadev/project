@extends('layouts.master', ['title' => "Admin - Tickets Check", "isAdmin" => 'true' ])
@php
    $class = '';
    if ( session('class') ) {
        switch (session('class')) {
            case 'danger':
                $class = 'is-invalid';
                break;
            default:
                $class = 'is-valid';
                break;
        }
    }
@endphp
@section('content')
    <div class="section fp center-container">
        {!! Form::open(['url' => '/admin/tickets', 'method' => 'POST']) !!}
            <div class="form-group">
                {!! Form::label('Ticket') !!}
                {!! Form::text('ticketID', null, ['class' => 'form-control ' . $class, 'placeholder' => 'Ticket']) !!}
                <small class="text-{{ session('class')  ? session('class') : 'muted' }}"> {!!   session('message') ? session('message') : 'Insert ticket for validation' !!} </small>
            </div>
            {!! Form::submit('Check', ['class' => 'btn btn-dark']) !!}
        {!! Form::close() !!}
    </div>
@endsection