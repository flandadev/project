@extends('layouts.master', ['title' => 'Admin Register'])
@section('content')
    @include('layouts.sessions')

    <div class="section fp center-container">
        {{ Form::open(['url' => '/admin/authenticate', 'method' => 'post']) }}
            {{ csrf_field() }}
            <div class="form-group">
                @php
                    $errors = session('errors');
                    $class = $errors['username'] ? 'is-invalid' : '';
                @endphp
                {{ Form::label('username', 'Username:') }}
                {{ Form::text('username', isset($username) ? $username : null, ['required', 'class' => 'form-control ' . $class, 'placeholder' => 'Username']) }}
            </div>
            <div class="form-group">
                @php
                    $errors = session('errors');
                    $class = $errors['password'] ? 'is-invalid' : '';
                @endphp

                {{ Form::label('password', 'Password:') }}
                {{ Form::password('password', ['required', 'class' => 'form-control ' . $class, 'placeholder' => '••••••••']) }}
                <small> Forgot your password? <a href="/admin/forgot">Click here</a> </small>
            </div>

            {!! Form::submit('LOGIN', ['class' => 'btn btn-primary']) !!}
        {{ Form::close() }}
    </div>
@endsection
