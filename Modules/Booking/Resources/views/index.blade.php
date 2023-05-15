@extends('admin.layout.base')

@section('title')
    Bookings
@endsection

@section('content')
    <div class="container-fluid">
        @include('admin.layout.alerts')
        <bookings-list></bookings-list>
    </div>
@endsection
