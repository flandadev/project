<style type="text/css">
    * {
        font-family: 'Helvetica', sans-serif;
    }

    html,
    body {
        background: #FF0AAE;
        color: #fff;
        font-size: 18px;
        padding: 25px;
    }

    p {
        font-size: 1.3em;
    }

    .special {
        background: #FF0AAE;
    }

    .page-break {
        page-break-after: always;
    }

    .page-break:last-of-type {
        page-break-after: auto;
    }

    .center {
        position: absolute;
        left: 50%;
        top: 50%;
        transform: translate(-50%, -50%);
    }

    .box {
        border: 1.5px dashed #fff;
        padding: 25px;
        color: #fff;
        text-align: center;
        text-transform: uppercase;
    }

    .greetings {
        position: absolute;
        font-style: normal;
        bottom: 0;
        right: 25px;
    }

    .greetings a {
        color: #00e28f;
        font-weight: bolder;
        font-style: italic;
    }
</style>

<meta charset="utf-8">
<title> FLANDA TICKETS </title>
@foreach ($tickets as $ticket)
    <h1 align="center"> Thank you for yor purchase! </h1>
    <br><br>
    <p align="justify">
        Thank you <b>{{ $user['first_name'] . ' ' . $user['last_name'] }}</b>, for your purchase, this is a ticket for <b>{{ $event['name'] }}</b>
    </p>
    <br><br>
    <br><br>

    <div class="center">
        <div class="box">
            <h1> {{ $ticket['value'] }} </h1>
            @if ($ticket['hasBus'])
                <h5> + Bus from {{ ucfirst(explode('-', $ticket['busType'])[0]) }} </h5>
            @endif
        </div>
    </div>
    <p class="greetings"> Thank you, <br> <a href="mailto:store@flanda.eu">
        Flanda's Team
    </a> </p>
    <div class="page-break"></div>
@endforeach
