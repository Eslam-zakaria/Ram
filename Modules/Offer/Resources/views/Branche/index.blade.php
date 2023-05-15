@extends('admin.layout.base')

@section('title')
   Offer City
@endsection

@section('content')
    <div class="container-fluid">
        @include('admin.layout.alerts')
        <offer-branches-list></offer-branches-list>
    </div>
@endsection
