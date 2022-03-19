<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Rank serv') }}</title>
</head>
<body class="bg-light">
    <div class="container">
        <img class="ax-center my-10 w-24" src="https://assets.bootstrapemail.com/logos/light/square.png" />
        <div class="card p-6 p-lg-10 space-y-4">
            <h1 class="h3 fw-700">
                Hey {{$user->pseudo}},
            </h1>
            <p>
                We have a request to change your address mail by {{$newEmail}}, if you're the requester click in the button !<br>
                Else if you do not this request, just ignore this message and change your password.
            </p>
            <a class="btn btn-primary p-3 fw-700" href="{{ route('index') }}">Rank-server</a>
        </div>
    </div>

    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/front/front.js') }}"></script>
    @yield('scripts')
</body>

</html>
