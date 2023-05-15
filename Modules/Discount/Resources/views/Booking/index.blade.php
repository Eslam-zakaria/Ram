@extends('admin.layout.base')

@section('title')
 Discount Booking
@endsection

@section('content')
    <div class="container-fluid">
        @include('admin.layout.alerts')
        <discount-bookings-list></discount-bookings-list>
    </div>
@endsection
