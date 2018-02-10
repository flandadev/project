@extends('layouts.master', ['title' => 'Admin - Password Reset', 'isAdmin' => 'true', 'fixed' => 'true'])
@section('content')
    @if ( session('message') )
        <div class="alert alert-{{ session('class')  }}">
            {!! session('message') !!}
        </div>
    @endif

    <div class="section fp center-container">
        <div class="table-responsive">
            <table class="table table-hover table-bordered">
                <thead>
                    <th> First Name </th>
                    <th> Last Name </th>
                    <th> Email </th>
                    <th> Action </th>
                </thead>
                <tbody>
                    @foreach($customers as $customer)
                        <tr>
                            <td> {{$customer->first_name}} </td>
                            <td> {{$customer->last_name}} </td>
                            <td> {{$customer->email}} </td>
                            <td>
                                <div class="row">
                                    <div class="col">
                                        {{ Form::open(['url' => '/admin/customers/' . $customer->id, 'method' => 'get', 'class' => 'no-style']) }}
                                            {!! Form::submit('Infos', ['class' => 'btn btn-info']) !!}
                                        {{ Form::close() }}
                                    </div>
                                    {{-- <div class="col">
                                        {{ Form::open(['url' => '/admin/customers/' . $customer->id . '/edit', 'method' => 'get', 'class' => 'no-style']) }}
                                            {!! Form::submit('Edit', ['class' => 'btn btn-warning']) !!}
                                        {{ Form::close() }}
                                    </div> --}}
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
