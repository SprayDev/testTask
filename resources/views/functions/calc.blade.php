@extends('main')

@section('content')
    <calculator :cities="{{ json_encode($cities) }}" user="{{Auth::id()}}"></calculator>
@endsection
