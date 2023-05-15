@extends('admin.layout.base')

@section('title')
    Jobs
@endsection

@section('content')
    <div class="container-fluid">
        @include('admin.layout.alerts')
        <jobs-list></jobs-list>
    </div>
@endsection
