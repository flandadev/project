@component('mail::message')
# Dashboard: Welcome

Congratulations {{ $admin->first_name }} {{ $admin->last_name }}, you are now an admin
of Flanda.

To access your dashboard please visit: [{{ env('APP_URL') }}/admin]({{ env('APP_URL') }}/admin)
you will find some usesful settings and statistics about the website and the ticket marketing.


Thanks,<br>
[the webmaster](mailto:fedevitale99@gmail.com)
@endcomponent
