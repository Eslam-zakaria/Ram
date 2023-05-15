@extends('admin.layout.base')

@section('title')
    Discounts
@endsection

@section('content')
    <div class="container-fluid">
        @include('admin.layout.alerts')
        <discounts-list></discounts-list>
    </div>
@endsection
