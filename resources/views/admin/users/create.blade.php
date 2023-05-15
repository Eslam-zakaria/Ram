@extends('admin.layout.base')

@section('title')
    Add new Admin User
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="basic-form">
                            <form class="form" method="POST" enctype="multipart/form-data" action="{{ route('admin.users.store') }}">
                                @method('POST')
                                @csrf

                                <div class="form-row">
                                    @include('admin.layout.field', field('text', 'name', 'Name', 6))
                                    @include('admin.layout.field', field('text', 'email', 'Email Address', 6))
                                    @include('admin.layout.field', field('password', 'password', 'Password', 6))
                                    @include('admin.layout.field', field('select', 'role', 'Role', 3,[], \App\Constants\Roles::getList()))

                                    @include('admin.layout.field', field('hidden', 'page', 'Page', 6))
                                </div>
                                <button type="submit" class="btn btn-primary btn-block">Save</button>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
