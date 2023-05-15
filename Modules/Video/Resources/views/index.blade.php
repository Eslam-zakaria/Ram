@extends('admin.layout.base')

@section('title')
Videos Dr
@endsection

@section('content')
    <div class="container-fluid">
        @include('admin.layout.alerts')
        <videos-list></videos-list>
    </div>
@endsection
