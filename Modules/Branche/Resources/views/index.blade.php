@extends('admin.layout.base')

@section('title')
    Branches
@endsection

@section('content')
    <div class="container-fluid">
        @include('admin.layout.alerts')
        <branches-list></branches-list>
    </div>
@endsection
