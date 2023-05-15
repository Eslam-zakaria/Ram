@extends('admin.layout.base')

@section('title')
Departments
@endsection

@section('content')
    <div class="container-fluid">
        @include('admin.layout.alerts')
        <departments-list></departments-list>
    </div>
@endsection
