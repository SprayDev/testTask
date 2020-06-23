<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Курьер</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="canonical" href="https://getbootstrap.com/docs/4.0/examples/sign-in/">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/signIn.css') }}" rel="stylesheet">
</head>
<body class="text-center">
<div class="container">
    {{Form::open(array('class' => 'form-signin', 'method' => 'post', 'action' => 'authController@login'))}}
    <h1 class="h3 mb-3 font-weight-normal">Авторизация</h1>
    <div class="form-group">
        <label for="inputEmail" class="sr-only">Логин</label>
        <input type="login" id="login" class="form-control" placeholder="Ваш ИД в системе ГБ" name="login" required autofocus>
    </div>
    <div class="form-group">
        <label for="inputPassword" class="sr-only">Пароль</label>
        <input type="password" id="inputPassword" class="form-control" placeholder="Пароль" name="password" required>
    </div>
    <div class="form-check">
        <input type="checkbox" id="remember" class="form-check-input" name="rememberMe">
        <label for="remember" class="form-check-label">Запомнить меня</label>
    </div>
    <div class="form-group">
        <button class="btn btn-lg btn-block btn-outline-exdel" type="submit">Войти</button>
        <a class="btn btn-lg btn-block btn-outline-exdel" href="https://post-master.ru/">Назад</a>
    </div>
    @if (session('alert'))
        <div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            {{ session('alert') }}
        </div>
    @endif
    {{Form::close()}}
</div>
</body>
</html>
