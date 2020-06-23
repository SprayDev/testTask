@extends('main')

@section('content')
    <profile :user="{{ json_encode($user) }}" :profile="{{ json_encode($person) }}" :cities="{{ json_encode($cities) }}" status="{{session('status')}}"></profile>
@endsection
