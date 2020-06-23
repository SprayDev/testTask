@php
    $begin = $docs[0];
    $end = array_pop($docs);
@endphp
<!doctype html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="{{asset('css/balancePdf.css')}}">
    <style type="text/css" media="all">
        .fl{
            float: left;
        }
        .fr{
            float: right;
        }
        @font-face {
            font-family: 'tahomaCust';
            font-style: normal;
            font-weight: normal;
            src: url({{asset('fonts/Tahoma.ttf')}}) format('truetype');
        }
        /*@font-face {
            font-family: 'arialT';
            font-style: normal;
            font-weight: normal;
            src: url({{asset('fonts/ArialMT.ttf')}}) format('truetype');
        }*/
        body{font-family: tahomaCust}

    </style>
</head>
<body style="background-color: white">
<div class="container">
    <div class="row">
        <div class="col-xs-6">
            <img width="380" src="img/pm_logo.jpg" alt="PostMaster">
        </div>
        <div class="col-xs-6">
            <p>{{$firmReq['address']}}, тел/факс {{$firmReq['phone']}} ИНН {{$firmReq['inn']}}</p>
        </div>
    </div>
    <div class="row">
        <div class="w-100" style="border: 1px solid black;width: 850px">
        </div>
    </div>
    <div class="row text-center">
        <p class="head">Акт сверки расчетов</p>
        <p class="head">между {{$firmReq['name']}}</p>
        <p class="head">и {{$partnerReq['name']}}</p>
        <p class="head">по состоянию на {{date('d.m.Y', strtotime($end['docDate']))}}</p>
    </div>
    <div class="row">
        <table border="1" cellpadding="1" cellspacing="0" height="100" width="100%">
            <tr>
                <td class="text-center" colspan="4">{{$firmReq['name']}}</td>
                <td class="text-center" colspan="2">{{$partnerReq['name']}}</td>
            </tr>
            <tr>
                <td class="text-center">Дата документа</td>
                <td class="text-center">Номер документа</td>
                <td class="text-center">Кредит</td>
                <td class="text-center">Дебет</td>
                <td class="text-center">Дебет</td>
                <td class="text-center">Кредит</td>
            </tr>
            <tr bgcolor="gray">
                <td class="text-center">Сальдо на</td>
                <td class="text-center">{{date('d.m.Y', strtotime($begin['docDate']))}}</td>
                <td class="text-right">{{$begin['credit']}}</td>
                <td class="text-right">{{$begin['debet']}}</td>
                <td style="border-right: none"></td>
                <td style="border-left: none"></td>
            </tr>
            @foreach($docs as $k=>$doc)
                @if($k != 0)
                    <tr>
                        <td class="text-center">{{date('d.m.Y', strtotime($doc['docDate']))}}</td>
                        <td class="text-center">{{$doc['number']}}</td>
                        <td class="text-right">{{$doc['credit']}}</td>
                        <td class="text-right">{{$doc['debet']}}</td>
                        <td class="text-center"></td>
                        <td class="text-center"></td>
                    </tr>
                @endif
            @endforeach
            <tr>
                <td class="text-center noBoard">Итого обороты</td>
                <td class="text-center noBoard"></td>
                <td class="text-right noBoard">{{$sumCredit}}</td>
                <td class="text-right noBoard">{{$sumDebet}}</td>
                <td class="text-center noBoard"></td>
                <td class="text-center noBoard"></td>
            </tr>
            <tr bgcolor="gray">
                <td class="text-center">Сальдо на</td>
                <td class="text-center">{{date('d.m.Y', strtotime($end['docDate']))}}</td>
                <td class="text-right">{{$end['credit']}}</td>
                <td class="text-right">{{$end['debet']}}</td>
                <td style="border-right: none"></td>
                <td style="border-left: none"></td>
            </tr>
        </table>
        <div class="row">
            <p>Итого: задолженость в пользу {{$litPartner}} составляет {{$SumLit}}</p>
        </div>
        <div class="row">
            <div class="col-xs-8">
                <p>{{$firmReq['name']}}</p>
            </div>
            <div class="col-xs-8">
                <p>{{$partnerReq['name']}}</p>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-6">
                <p>Директор ____________________/{{$firmReq['boss']}}/</p>
            </div>
            <div class="col-xs-8">
                <p>Директор ____________________/{{$partnerReq['boss']}}/</p>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-6">
                <p>Гл. Бухгалтер ____________________/{{$firmReq['buh']}}/</p>
            </div>
            <div class="col-xs-8">
                <p>Гл. Бухгалтер ____________________/{{$partnerReq['buh']}}/</p>
            </div>
        </div>
    </div>
</div>
</body>
</html>
