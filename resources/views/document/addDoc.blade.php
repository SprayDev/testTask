@extends('main')

@section('content')
    <div class="container">
        <add-doc :cities="{{ json_encode($cities) }}" :temps="{{ json_encode($temps) }}"></add-doc>
    </div>
@endsection
