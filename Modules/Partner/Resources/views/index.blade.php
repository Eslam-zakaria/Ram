@extends('admin.layout.base')

@section('title')
    Partners
@endsection

@section('content')
    <div class="container-fluid">
        @include('admin.layout.alerts')
        <partners-list></partners-list>
    </div>
@endsection
