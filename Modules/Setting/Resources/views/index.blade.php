@extends('admin.layout.base')

@section('title')
    Settings
@endsection

@section('content')
    <div class="container-fluid">
        @include('admin.layout.alerts')
        <settings-list></settings-list>
    </div>
@endsection
