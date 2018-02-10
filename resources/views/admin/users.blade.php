@extends('layouts.master', ['title' => 'Admins list', 'isAdmin' => true])
@section('styles')
    <style>
        .fixed {
            position: fixed;
            bottom: 20px;
            left: 20px;
        }
    </style>
@endsection
@section('content')
    <div class="section fp">
        <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover">
                <thead>
                <th> First Name </th>
                <th> Last Name  </th>
                <th> Username   </th>
                <th> Email      </th>
                <!-- <td> Action     </td> -->
                </thead>
                <tbody>
                @php
                    $logged = auth()->user()->email;
                @endphp

                @foreach ($admins as $admin)
                    <tr>
                        <td> {{ $admin->first_name }} </td>
                        <td> {{ $admin->last_name }} </td>
                        <td> {{ $admin->username }} </td>
                        <td> {{ $admin->email }} </td>
                    <!-- <td>
                            @if ($logged != $admin->email)
                        {{ Form::open(['url' => '/admin/users/' . $admin->id, 'class' => 'no-style', 'method' => 'delete']) }}
                        {{ Form::submit('&times;', array('class' => 'btn btn-danger')) }}
                        {{ Form::close() }}
                    @else
                        <span class="btn btn-danger disabled" title="You can't delete yourself!" style="cursor: not-allowed;">DELETE</span>
@endif
                            </td> -->
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="event--button fixed">
        <a class="btn btn-success" href="/admin/new">
            New User
        </a>
    </div>
@endsection
