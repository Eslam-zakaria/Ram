@extends('admin.layout.base')

@section('title')
    Cards
@endsection

@section('content')
    <div class="container-fluid">
        @include('admin.layout.alerts')
        <cards-list></cards-list>
    </div>
@endsection
