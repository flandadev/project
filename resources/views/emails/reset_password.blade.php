@component('mail::message')
# Password Reset

Hey {{ $user['username'] }}, it seems that you've lost your password...

Bad, really bad, but today you are a lucky man! Yes believe me! I've got an
url to reset your password directly from the server...

Click on the button below to reset.

@component('mail::button', ['url' => env('APP_URL') . '/admin/reset/' . sha1($user->email . env('APP_SALT')) . '?mail=' . $user->email])
    Reset now
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
