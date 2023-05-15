@extends('admin.layout.base')

@section('title')
    Edit a Blog Category ({{ $form->name }})
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="basic-form">
                            <form class="form" method="POST" enctype="multipart/form-data" action="{{ route('admin.blog-categories.update', ['blog_category' => $form->id]) }}">
                                @method('PUT')
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
                                                        <!-- @include('admin.layout.field', field('text', $locale.'[name]', 'Name', 6, $form->translate($locale), ['key' => 'name'])) -->
                                                        <div class="form-group bmd-form-group col-md-6 @error("$locale.name") has-danger @enderror">
                                                            <label for="name_id"> Name {{ $locale }} <span class="text-danger">*</span></label>
                                                            <input type="text" id="name_id" name="{{ $locale }}[name]" placeholder="Enter name" value="{{ $form->translate($locale)->name }}" class="form-control" />

                                                            @error("$locale.name")
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                        <div class="form-group col-md-6 @error("$locale.slug") has-danger @enderror">
                                                            <label for="slug_id"> Slug {{ $locale }} <span class="text-danger">*</span></label>
                                                            <input type="text" id="slug_id" name="{{ $locale }}[slug]" placeholder="Enter slug" value="{{ $form->translate($locale)->slug }}" class="form-control" />

                                                            @error("$locale.slug")
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                        <div class="header-left mt-2 mb-2" style="border: dashed;background-color: #e3e3e387;">
                                                            <div class="dashboard_bar ml-2">
                                                                Seo Details {{ $locale }}
                                                            </div>
                                                        </div>
                                                        <!-- @include('admin.layout.field', field('text', $locale.'[meta_title]', 'Meta Title', 6, [], ['key' => 'meta_title'])) -->
                                                        <div class="form-group col-md-6">
                                                            <label for="meta_title"> Meta Title {{ $locale }} </label>
                                                            <input type="text" id="meta_title" name="{{ $locale }}[meta_title]" placeholder="Enter title" value="{{ $form->translate($locale)->meta_title }}" class="form-control" />
                                                        </div>
                                                        <!-- @include('admin.layout.field', field('text', $locale.'[canonical_url]', 'Canonical Url', 6, [], ['key' => 'canonical_url'])) -->
                                                        <div class="form-group col-md-6">
                                                            <label for="canonical_url"> Canonical Url {{ $locale }} </label>
                                                            <input type="text" id="canonical_url" name="{{ $locale }}[canonical_url]" placeholder="Enter title" value="{{ $form->translate($locale)->canonical_url }}" class="form-control" />
                                                        </div>
                                                        <!-- @include('admin.layout.field', field('textarea', $locale.'[meta_description]', 'Meta Description', 6, [], ['key' => 'meta_description'])) -->
                                                        <div class="form-group col-md-6">
                                                            <label for="meta_description"> Meta Description {{ $locale }}</label>
                                                            <textarea id="meta_description" name="{{ $locale }}[meta_description]" class="form-control" rows="10">{{ $form->translate($locale)->meta_description }}</textarea>
                                                        </div>
                                                        <!-- @include('admin.layout.field', field('textarea', $locale.'[meta_keywords]', 'Meta Keywords', 6, [], ['key' => 'meta_keywords'])) -->
                                                        <div class="form-group col-md-6">
                                                            <label for="meta_keywords"> Meta Keywords {{ $locale }}</label>
                                                            <textarea id="meta_keywords" name="{{ $locale }}[meta_keywords]" class="form-control" rows="10">{{ $form->translate($locale)->meta_keywords }}</textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach

                                        </div>
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-primary pull-right">Save</button>
                                <button type="button" onclick="parent.history.back();" class="btn btn-danger">Back</button>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
