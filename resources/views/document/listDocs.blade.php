@extends('main')

@section('content')
    <div class="container">
        <table-docs :docs="{{ json_encode($docs) }}"></table-docs>
    </div>
@endsection
