@extends('admin.layout.base')

@section('title')
    Users
@endsection

@section('content')
    <div class="container-fluid">
        @include('admin.layout.alerts')
        <users-list></users-list>
    </div>
@endsection
