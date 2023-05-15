@extends('admin.layout.base')

@section('title')
   Blog Categories
@endsection

@section('content')
    <div class="container-fluid">
        @include('admin.layout.alerts')
        <blog-categories-list></blog-categories-list>
    </div>
@endsection
