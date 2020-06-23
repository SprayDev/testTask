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

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/main.css') }}" rel="stylesheet">
    <link href="{{ asset('css/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
</head>
<body>
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
                <a class="nav-link exdel-li-a pr-3 pl-3" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Накладная
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="{{route('home')}}">Список накладных</a>
                    <a class="dropdown-item" href="{{route('addDocView')}}">Создать накладную</a>
                </div>
            </li>
            <li class="nav-item exdel-list">
                <a class="nav-link exdel-li-a pr-3 pl-3" href="{{route('calc')}}">Калькулятор</a>
            </li>
        </ul>
        <div class="call-track">
            <a href="tel:+73912052020" class="phone mr-3">+7 (391) 205-20-20</a>
            {{Form::open(array('class' => "form-inline my-2 my-lg-0", 'method' => 'put', 'action'=>"HomeController@track"))}}
                <input class="form-control mr-sm-2" type="search" placeholder="Трекинг" aria-label="Search" name="number">
                <button class="btn btn-outline-exdel my-2 my-sm-0" type="submit">Отследить</button>
            {{Form::close()}}
        </div>
        <div class="pl-5">
            <a style="color: black" href="{{route('profile')}}">{{$user->name}}</a>
            <a style="color: #2c1e5b" href="/logout"><i class="fa fa-sign-out" aria-hidden="true"></i></a>
        </div>
    </div>
</nav>
<main role="main" id="app">
    @yield('content')
</main>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.maskedinput/1.4.1/jquery.maskedinput.min.js"></script>
<script>

    window.onload = function () {
       /*
        console.log(test);
        var heatmapInstance = h337.create({
            container: document.querySelector('body'),
            radius: 50
        });
        test.forEach(function (item, i) {
            heatmapInstance.addData({
                x: item.clickX,
                y: item.clickY,
                value: 1
            });
        })*/
        /*console.log(heatmapInstance);
        document.querySelector('body').onclick = function(ev) {
            heatmapInstance.addData({
                x: ev.clientX,
                y: ev.clientY,
                value: 1
            });
        };*/
    }
</script>
</body>
</html>
