@extends('main')

@section('content')
    <div class="container">
        <get-doc :cities="{{ json_encode($cities) }}" :doc="{{ json_encode($doc) }}"></get-doc>
    </div>
@endsection
