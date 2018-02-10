@extends('layouts.master', ['title' => 'Admin Register'])
@section('content')
    @include('layouts.sessions');

    <div class="section fp center-container">
        {{ Form::open(['url' => '/admin/users', 'method' => 'post']) }}
            {{csrf_field()}}
            <div class="form-row">
                <div class="col form-group">
                    @php $class = $errors->first_name ? $errors->first_name : ''; @endphp
                    {{ Form::label('first_name', 'First:') }}
                    {{ Form::text('first_name', null, ['class' => 'form-control ' . $class, 'placeholder' => 'First Name', 'required']) }}
                </div>
                <div class="col form-group">
                    @php $class = $errors->last_name ? $errors->last_name : ''; @endphp
                    {{ Form::label('last_name', 'Last:') }}
                    {{ Form::text('last_name', null, ['class' => 'form-control ' . $class, 'placeholder' => 'Last Name', 'required']) }}
                </div>
            </div>
            <div class="form-group">
                @php $class = $errors->username ? $errors->username : ''; @endphp
                {{ Form::label('username', 'Username:') }}
                {{ Form::text('username', null, ['class' => 'form-control ' . $class, 'placeholder' => 'Username', 'required']) }}
            </div>
            <div class="form-group">
                @php $class = $errors->email ? $errors->email : ''; @endphp
                {{ Form::label('email', 'Email:') }}
                {{ Form::email('email', null, ['class' => 'form-control ' . $class, 'placeholder' => 'Email', 'required']) }}
            </div>
            <div class="form-group">
                @php $class = $errors->password ? $errors->password : ''; @endphp
                {{ Form::label('password', 'Password:') }}
                {{ Form::password('password', ['class' => 'form-control ' . $class, 'placeholder' => '••••••••', 'required']) }}
                <small class="text-muted"> Password must be at least 8 characted. </small>
            </div>
            <div class="form-group">
                @php $class = $errors->password_confirmation ? $errors->password_confirmation : ''; @endphp
                {{ Form::label('password_confirmation', 'Password confirmation') }}
                {{ Form::password('password_confirmation', ['class' => 'form-control ' . $class, 'placeholder' => 'Password again', 'required']) }}
            </div>

            {!! Form::submit('REGISTER', ['class' => 'btn btn-primary']) !!}
        {{ Form::close() }}
    </div>
@endsection
