@extends('layouts.master', ['title' => 'Showcase: ' . $event->title, 'isAdmin' => true])
@section('styles')
    {{ Html::style('/css/events.min.css') }}
@endsection
@section('content')
    <div class="section fp event no-pad">
        <h2 class="event--title" style="color: #2d2d2d"> {{ $event->name }} </h2>
        {{-- <small class="subtitle"> {{ $event->event_date->format('Y-m-d') }} </small> --}}
        <p class="event--descr">
            {{ $event->descr }}
        </p>

        <div class="event--button fixed">
            <a class="btn btn-dark" href="/admin/events/{{ $event->event_token }}/edit">
                EDIT
            </a>
            <a class="btn btn-primary back" href="/admin/events">
                BACK
            </a>
            {!! Form::open(['url' => "/admin/events/" . $event->event_token, 'method' => 'delete', 'class' => 'no-style']) !!}
                {!! Form::submit('DELETE', ['class' => 'btn btn-danger']) !!}
            {!! Form::close() !!}
        </div>
    </div>
@endsection
