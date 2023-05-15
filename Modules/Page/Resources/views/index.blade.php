@extends('admin.layout.base')

@section('title')
    Pages
@endsection

@section('content')
    <div class="container-fluid">
        @include('admin.layout.alerts')
        <pages-list></pages-list>
    </div>
@endsection
