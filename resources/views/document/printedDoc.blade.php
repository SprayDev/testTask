<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>PostMaster</title>

    <script src="{{ asset('js/app.js') }}" defer></script>

    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/printed.css') }}" rel="stylesheet">
    <link href="{{ asset('css/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
</head>
<body style="background-color: white">
    <div id="app">
        <print-doc :doc="{{json_encode($doc)}}"></print-doc>
    </div>
</body>
</html>
