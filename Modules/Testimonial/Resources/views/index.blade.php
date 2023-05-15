@extends('admin.layout.base')

@section('title')
    Testimonials
@endsection

@section('content')
    <div class="container-fluid">
        @include('admin.layout.alerts')
        <testimonials-list></testimonials-list>
    </div>
@endsection
