@extends('layouts.master', ['title' => 'EDIT: ' . $event->name, 'isAdmin' => true])
@section('styles')
    {{ Html::style('/css/admin.min.css') }}
    {{ Html::style('/css/form.min.css') }}
@endsection
@section('content')
    <div class="section fp center-container">
        <form id="edit" method="post" action="/admin/events/{{ $event->event_token }}" class="admin-form">
            {!! method_field('patch') !!}
            {!! csrf_field() !!}

            <div class="form-group">
                <label for="name">Event Name:</label>
                <input required type="text" name="name" placeholder="{{ $event->name }}" value="{{ $event->name }}" class="form-control">
            </div>
            <div class="form-group">
                <label for="descr">Event Description:</label>
                <textarea required name="descr" class="form-control" placeholder="{{ $event->descr }}">{{ $event->descr }}</textarea>
            </div>
            <div class="form-group">
                <label for="price">Event Price:</label>
                <input required type="number" name="price" placeholder="{{ $event->price }}" value="{{ $event->price }}" class="form-control">
            </div>
            <div class="form-group">
                <label for="event_date">Event Date:</label>
                <input required type="date" value="{{ \Carbon\Carbon::parse($event->event_date)->format('Y-m-d') }}" name="event_date" class="form-control">
            </div>

            <input type="submit" value="edit" class="btn btn-warning">
            <a href="/admin/events" class="btn btn-secondary">back</a>
        </form>
    </div>
@endsection
@section('scripts')
    <script type="text/javascript">
        $('form#edit').on('submit', function(e) {
            let send = confirm('[WARN] Are you sure???')
            return send;
        })
    </script>
@endsection
