@extends('admin.layout.base')

@section('title')
    specificities
@endsection

@section('content')
    <div class="container-fluid">
        @include('admin.layout.alerts')
        <specificities-list></specificities-list>
    </div>
@endsection
