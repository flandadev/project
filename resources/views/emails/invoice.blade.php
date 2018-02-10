@php
    $event = $data['event'];
    $tickets = $data['tickets'];
    $customer = $data['user'];
@endphp

@component('mail::message')
# Ticket/s for {{ $event->name }}

{{-- Description --}}
Thank you {{ $customer->first_name }}!
Here's your tickets:
@foreach ($tickets as $ticket)
    - {{ $ticket['value'] }}
@endforeach

We've attached a pdf file with all the tickets that you can bring wit you to the bus.

Thanks,<br>
<a href="https://flanda.eu">
    {{ config('app.name') }} Team
</a>
@endcomponent
