@extends('admin.layout.base')

@section('title')
   Casing Categories
@endsection

@section('content')
    <div class="container-fluid">
        @include('admin.layout.alerts')
        <Casing-categories-list></Casing-categories-list>
    </div>
@endsection