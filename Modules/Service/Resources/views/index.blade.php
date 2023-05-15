@extends('admin.layout.base')

@section('title')
Services
@endsection

@section('content')
    <div class="container-fluid">
        @include('admin.layout.alerts')
        <services-list></services-list>
    </div>
@endsection
