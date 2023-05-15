@extends('admin.layout.base')

@section('title')
Sub Specialities
@endsection

@section('content')
    <div class="container-fluid">
        @include('admin.layout.alerts')
        <categories-list></categories-list>
    </div>
@endsection
