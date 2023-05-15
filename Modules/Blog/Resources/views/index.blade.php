@extends('admin.layout.base')

@section('title')
    Blogs
@endsection

@section('content')
    <div class="container-fluid">
        @include('admin.layout.alerts')
        <blogs-list></blogs-list>
    </div>
@endsection
