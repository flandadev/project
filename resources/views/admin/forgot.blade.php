@extends('layouts.master', ['title' => 'Admin - Password Reset'])
@section('content')
    @include('layouts.sessions')

    <div class="section fp center-container">
        {{ Form::open(['url' => '/admin/forgot', 'method' => 'POST']) }}
            <div class="form-group">
                {{ Form::label('email', 'Email:') }}
                {{ Form::email('email', null, ['class' => 'form-control', 'placeholder' => 'Email', 'required']) }}
								<small class="text-dark"> Do you remember it? <a href="/admin/login">Login here</a> </small>
            </div>
            {{ Form::submit('Reset Password', ['class' => 'btn btn-dark']) }}
        {{ Form::close() }}
    </div>
@endsection
