@extends('admin.layout.base')

@section('title')
    Create a new Page
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="basic-form">
                            <form class="form" method="POST" enctype="multipart/form-data" action="{{ route('admin.pages.store') }}">
                                @method('POST')
                                @csrf

                                <div class="form-row " style="margin-bottom:  10px">
                                    <div class="default-tab " style="width: 100%">
                                        <ul class="nav nav-tabs" role="tablist">
                                            @foreach(config('translatable.locales') as $locale)
                                                <li class="nav-item">
                                                    <a class="nav-link {{ $loop->first ? 'active' : '' }}" data-toggle="tab" href="#{{ $locale }}">  {{ trans('messages.'.$locale) }}</a>
                                                </li>
                                            @endforeach
                                        </ul>
                                        <div class="tab-content">
                                            @foreach(config('translatable.locales') as $locale)
                                                <div class="tab-pane fade {{ $loop->first ? "active show" : '' }}" id="{{ $locale }}" role="tabpanel">
                                                    <div class="pt-4">
                                                        @include('admin.layout.field', field('text', $locale.'[name]', 'Name', 6, [], ['key' => 'name']))
                                                        @include('admin.layout.field', field('textarea', $locale.'[description]', 'Description', 6, [], ['key' => 'description']))
                                                    </div>
                                                </div>
                                            @endforeach

                                        </div>
                                    </div>

                                    @include('admin.layout.field', field('text', 'slug', 'Slug', 3))
                                    @include('admin.layout.field', field('file', 'image', 'Image', 12))
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
s
