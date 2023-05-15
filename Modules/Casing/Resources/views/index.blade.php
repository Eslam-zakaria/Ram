@extends('admin.layout.base')

@section('title')
    Casings
@endsection

@section('content')
    <div class="container-fluid">
        @include('admin.layout.alerts')
        <Casing-list></Casing-list>
    </div>
@endsection