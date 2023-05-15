@extends('admin.layout.base')

@section('title')
SUBSCRIPTIONS & CONTACTUS
@endsection

@section('content')
    <div class="container-fluid">
        @include('admin.layout.alerts')
        <tickets-list></tickets-list>
    </div>
@endsection
