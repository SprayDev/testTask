@extends('main')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col d-inline">
                <span class="font-weight-bolder">Номер накладной: </span>
                <span>{{$status[1]['docnumber']}}</span>
            </div>
            <div class="col d-inline">
                <span class="font-weight-bolder">Город отправки: </span>
                <span>{{$status[1]['senderCity']}}</span>
            </div>
            <div class="col d-inline">
                <span class="font-weight-bolder">Город доставки: </span>
                <span>{{$status[1]['deliveryCity']}}</span>
            </div>
            <div class="w-100"></div>
            <div class="col d-inline">
                <span class="font-weight-bolder">Партнер: </span>
                <span>{{$status[1]['partner']}}</span>
            </div>
            <div class="col d-inline">
                <span class="font-weight-bolder">Отправитель: </span>
                <span>{{$status[1]['sender']}}</span>
            </div>
            <div class="col d-inline">
                <span class="font-weight-bolder">Получатель: </span>
                <span>{{$status[1]['recipient']}}</span>
            </div>
        </div>
        <table class="table">
            <thead class="thead-light thead-exdel">
                <tr>
                    <th>Дата/Время</th>
                    <th>Статус</th>
                </tr>
            </thead>
            <tbody>
            @foreach($status as $item)
                <tr>
                    <td scope="col">{{ $item['date'] }}</td>
                    <td scope="col">{{ $item['point'] }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
