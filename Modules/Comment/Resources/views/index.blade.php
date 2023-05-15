@extends('admin.layout.base')

@section('title')
    Comments
@endsection

@section('content')
    <div class="container-fluid">
        @include('admin.layout.alerts')
        <comments-list></comments-list>
    </div>
@endsection
