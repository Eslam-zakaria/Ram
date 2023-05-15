@extends('admin.layout.base')

@section('title')
   Discount Categories
@endsection

@section('content')
    <div class="container-fluid">
        @include('admin.layout.alerts')
        <discount-categories-list></discount-categories-list>
    </div>
@endsection
