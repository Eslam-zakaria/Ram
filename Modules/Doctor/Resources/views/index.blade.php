@extends('admin.layout.base')

@section('title')
    Doctors
@endsection

@section('content')
    <div class="container-fluid">
        @include('admin.layout.alerts')
        <doctors-list></doctors-list>
    </div>
@endsection
