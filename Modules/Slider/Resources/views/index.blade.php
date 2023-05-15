@extends('admin.layout.base')

@section('title')
    Sliders
@endsection

@section('content')
    <div class="container-fluid">
        @include('admin.layout.alerts')
        <sliders-list></sliders-list>
    </div>
@endsection
