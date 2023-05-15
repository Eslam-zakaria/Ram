@extends('admin.layout.base')

@section('title')
Leads
@endsection

@section('content')
    <div class="container-fluid">
        @include('admin.layout.alerts')
        <leads-list></leads-list>
    </div>
@endsection
