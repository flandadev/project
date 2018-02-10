@extends('layouts.master', ['title' => 'Admin Page', 'isAdmin' => true])
@section('content')
@php
    if (count($errors)) {
        dd($errors->toArray());
    }
@endphp
    <div class="section fp center-container">
        <form id="create" method="post" action="/admin/events" class="admin-form">
            {{ csrf_field() }}
            <div class="form-group">
                <label for="name">Event Name:</label>
                <input type="text" name="name" placeholder="Event name" class="form-control">
            </div>
            <div class="form-group">
                <label for="descr">Event Description:</label>
                <textarea name="descr" class="form-control" placeholder="Event description"></textarea>
            </div>
            <div class="form-group">
                <label for="flyer">Flyer URL:</label>
                <input type="text" name="flyer" placeholder="http://someurl.com/path/to/img" class="form-control">
            </div>
            <div class="form-group">
                <label for="price">Event Price:</label>
                <input type="number" name="price" placeholder="19.99" class="form-control">
            </div>
            <div class="form-group">
                <label for="event_date">Event Date:</label>
                <input id="date" type="date" name="event_date" class="form-control" placeholder="MM/DD/YYYY">
                <input type="hidden" id="alternate" name="alternate">
                <small class="text-muted"> Format: MM/DD/YYYY </small>
            </div>
            <div class="form-group">
                <label for="av_tickets">Available Tickets:</label>
                <input required type="text" name="av_tickets" placeholder="350" value="350" class="form-control">
            </div>

            <input type="hidden" name="event_token" value="">

            <input type="submit" class="btn btn-info">
        </form>
    </div>
@endsection
@section('scripts')
    {!! Html::script('/js/admin.js') !!}
    <script type="text/javascript">
        $('form#create').on('submit', function(e) {
            let send = confirm('[WARN] Are you sure???')
            return send;
        });
    </script>
@endsection
