@extends('admin.layout.base')

@section('title')
   Offer Booking
@endsection

@section('content')
    <div class="container-fluid">
        @include('admin.layout.alerts')
        <offer-bookings-list></offer-bookings-list>
    </div>
@endsection
