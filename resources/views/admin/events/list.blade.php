@extends('layouts.master', ['title' => 'Admin', 'isAdmin' => true])
@section('styles')
    {!! Html::style('/css/form.min.css') !!}
    {!! Html::style('/css/admin.min.css') !!}
@endsection
@section('content')
        @if (count($events))
            <div class="section fp scroll-lock-x">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <th> Name </th>
                            <th> Date </th>
                            <th> Remaining Tickets </th>
                            <th> Balance </th>
                            <th> ACTION </th>
                        </thead>
                        <tbody>
                        @foreach ($events as $event)
                            <tr>
                                <td> {{ $event->name }} </td>
                                <td> {{ \Carbon\Carbon::parse($event->event_date)->diffForHumans() }} </td>
                                <td> {{ ($event->tickets == $event->sold_tickets) ? 'SOLD OUT' : $event->tickets - $event->sold_tickets }} </td>
                                <td> {{ $event->balance->value / 100  }} € </td>
                                <td class="inline-items">
                                    <a class="btn btn-dark" href="/admin/events/{{ $event->event_token }}">
                                        PREVIEW
                                    </a>
                                    {{ Form::open(['url' => '/admin/events/' . $event->event_token, 'class' => 'no-style', 'method' => 'delete']) }}
                                    {{ Form::submit('&times;', array('class' => 'btn btn-danger')) }}
                                    {{ Form::close() }}
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="menu fixed-bottom">
                <a href="/admin/events/create" class="btn btn-add"> + </a>
            </div>
        @else
            <div class="section fp center-container">
                <div>
                    <h3> No events found </h3>
                    <div style="text-align: center">
                        <a style="margin: 10px" class="btn btn-success" href="/admin/events/create">Create new</a>
                    </div>
                </div>
            </div>
        @endif
@endsection

@section('scripts')
    <script type="text/javascript">
        $('form#delete').on('submit', function(e) {
            let send = confirm('[WARN] Are you sure???')
            return send;
        })
    </script>
@endsection
