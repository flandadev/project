@extends('layouts.master', ['title' => 'Admin - Password Reset'])
@section('content')
    @include('layouts.sessions')

    <div class="section fp center-container">
        {{ Form::open(['url' => '/admin/reset', 'method' => 'POST']) }}
            <div class="form-group">
                {{ Form::label('email', 'Email:') }}
                {{ Form::email('email', $user->email, ['readonly', 'class' => 'form-control', 'placeholder' => 'Email', 'required']) }}
            </div>

            <div class="form-group">
                {{ Form::label('password', 'New Password:') }}
                {{ Form::password('password', ['class' => 'form-control', 'placeholder' => 'Your new strong password', 'required']) }}
                <small class="text-muted"> Must be at least 8 characters. </small>
            </div>
            <div class="form-group">
                {{ Form::label('password_confirmation', 'Confirm:') }}
                {{ Form::password('password_confirmation', ['class' => 'form-control', 'disabled', 'placeholder' => 'Retype the password', 'required']) }}
                <small class="hint"> Must be the same </small>
            </div>

            {{ Form::submit('Reset Password', ['class' => 'btn btn-primary']) }}
        {{ Form::close() }}
    </div>
@endsection
@section('scripts')
    <script type="text/javascript">
        $('#password_confirmation').keyup(function () {
            var _self = $(this);

            if ($('#password').val().length >= 8) {
                if ($('#password').val() == _self.val()) {
                    $('[type="password"]').removeClass('is-invalid');
                    $('[type="password"]').addClass('is-valid');
                } else {
                    $('[type="password"]').removeClass('is-valid');
                    $('[type="password"]').addClass('is-invalid');
                }
            }
        });

        $('#password').keyup(function () {
            var _self = $(this);

            if (_self.val().length < 8) {
                _self.removeClass('is-valid');
                _self.addClass('is-invalid');
                $('#password_confirmation').prop('disabled', true);
            } else if (_self.val().length >= 8) {
                $('#password_confirmation').prop('disabled', false);
                _self.removeClass('is-invalid');
                _self.addClass('is-valid');
            }

            if ($('#password_confirmation').val().length > 0) {
                if ($('#password_confirmation').val() == _self.val()) {
                    $('[type="password"]').removeClass('is-invalid');
                    $('[type="password"]').addClass('is-valid');
                    $('.hint').html('Password doesn\'t match.');
                } else {
                    $('[type="password"]').removeClass('is-valid');
                    $('[type="password"]').addClass('is-invalid');
                }
            }

        });
    </script>
@endsection