@extends('admin.layout.base')

@section('title')
    Edit a User ({{ $form->name }})
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="basic-form">
                            <form class="form" method="POST" action="{{ route('admin.users.update', ['user' => $form->id]) }}">
                                @method('PUT')
                                @csrf

                                <div class="form-row">
                                    @include('admin.layout.field', field('text', 'name', 'Name', 6, $form))
                                    @include('admin.layout.field', field('text', 'email', 'Email Address', 6, $form))
                                    @include('admin.layout.field', field('password', 'password', 'Password', 6, $form))
                                    @include('admin.layout.field', field('select', 'role', 'Role', 3,$form, \App\Constants\Roles::getList()))
                                    @include('admin.layout.field', field('hidden', 'page', 'Page', 6, request()->get('page')))
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
