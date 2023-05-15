@extends('admin.layout.base')

@section('title')
    Job Requests
@endsection

@section('content')
    <div class="container-fluid">
        @include('admin.layout.alerts')
        <job-requests-list></job-requests-list>
    </div>
@endsection
