<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>PostMaster</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/main.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/main.css') }}" rel="stylesheet">
    <link href="{{ asset('css/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
</head>
<body style="height: 100vh">
<?php
$user = \App\User::find(Auth::id());
?>
<nav class="navbar navbar-expand-lg navbar-dark bg-light bg-exdel">
    <a class="navbar-brand" href="https://post-master.ru/"><img src="/img/logo_pm.png"></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse exdel-nav" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto exdel-ul">
            <li class="nav-item dropdown exdel-list">
                <a class="nav-link exdel-li-a pr-3 pl-3" href="{{route('testTask')}}">
                    Карта кликов
                </a>
            </li>
            <li class="nav-item exdel-list">
                <a class="nav-link exdel-li-a pr-3 pl-3" href="{{route('taskGraph')}}">График</a>
            </li>
        </ul>
        <div class="pl-5">
            <a style="color: black" href="{{route('profile')}}">{{$user->name}}</a>
            <a style="color: #2c1e5b" href="/logout"><i class="fa fa-sign-out" aria-hidden="true"></i></a>
        </div>
    </div>
</nav>
<main role="main" id="app">
    <div class="container">
        <graph></graph>
    </div>
</main>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.maskedinput/1.4.1/jquery.maskedinput.min.js"></script>
</body>
</html>

