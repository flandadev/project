@component('mail::message')
# Password Reset

C0ngratulations

@component('mail::button', ['url' => env('APP_URL') . '/admin'])
    Login
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
