@extends('admin.layout.base')

@section('title')
    Edit a Offer City ({{ $form->name }})
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="basic-form">
                            <form class="form" method="POST" enctype="multipart/form-data" action="{{ route('admin.offer-branches.update', ['offer_branch' => $form->id]) }}">
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
                                                    <div class="pt-4 row">
                                                        <!-- @include('admin.layout.field', field('text', $locale.'[name]', 'Name', 6, $form->translate($locale), ['key' => 'name'])) -->
                                                        <div class="form-group bmd-form-group col-md-6 @error("$locale.name") has-danger @enderror">
                                                            <label for="name_id"> Name {{ $locale }} <span class="text-danger">*</span></label>
                                                            <input type="text" id="name_id" name="{{ $locale }}[name]" placeholder="Enter name" value="{{ $form->translate($locale)->name }}" class="form-control" />

                                                            @error("$locale.name")
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                        <!-- @include('admin.layout.field', field('text', $locale.'[slug]', 'Slug', 6, $form->translate($locale), ['key' => 'slug'])) -->
                                                        <div class="form-group bmd-form-group col-md-6 @error("$locale.slug") has-danger @enderror">
                                                            <label for="slug_id"> Slug {{ $locale }} <span class="text-danger">*</span></label>
                                                            <input type="text" id="slug_id" name="{{ $locale }}[slug]" placeholder="Enter slug" value="{{ $form->translate($locale)->slug }}" class="form-control" />

                                                            @error("$locale.slug")
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                        <!-- @include('admin.layout.field', field('text', $locale.'[desc_offer]', 'Title Offer', 6, $form->translate($locale), ['key' => 'desc_offer'])) -->
                                                        <div class="form-group bmd-form-group col-md-6 @error("$locale.desc_offer") has-danger @enderror">
                                                            <label for="desc_id"> Title Offer {{ $locale }} <span class="text-danger">*</span></label>
                                                            <input type="text" id="desc_id" name="{{ $locale }}[desc_offer]" placeholder="Enter Title" value="{{ $form->translate($locale)->desc_offer }}" class="form-control" />

                                                            @error("$locale.desc_offer")
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                        <!-- @include('admin.layout.field', field('text', $locale.'[currency]', 'Currency', 6, $form->translate($locale), ['key' => 'currency'])) -->
                                                        <div class="form-group bmd-form-group col-md-6 @error("$locale.currency") has-danger @enderror">
                                                            <label for="currency_id"> Currency {{ $locale }} <span class="text-danger">*</span></label>
                                                            <input type="text" id="currency_id" name="{{ $locale }}[currency]" placeholder="Enter currency" value="{{ $form->translate($locale)->currency }}" class="form-control" />

                                                            @error("$locale.currency")
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                        <div class="header-left mt-2 mb-2 col-md-12" style="border: dashed;background-color: #e3e3e387;">
                                                            <div class="dashboard_bar ml-2">
                                                                Seo Details {{ $locale }}
                                                            </div>
                                                        </div>

                                                        <div class="form-group col-md-12 mt-3">
                                                            <label for="meta_title"> Meta Title {{ $locale }} </label>

                                                            <input type="text"
                                                                   id="meta_title"
                                                                   name="{{ $locale }}[meta_title]"
                                                                   placeholder="Enter title"
                                                                   value="{{ $form->translate($locale)->meta_title ?? '' }}"
                                                                   class="form-control" />
                                                        </div>

                                                        <div class="form-group col-md-12">
                                                            <label for="canonical_url"> Canonical Url {{ $locale }} </label>

                                                            <input type="text"
                                                                   id="canonical_url"
                                                                   name="{{ $locale }}[canonical_url]"
                                                                   placeholder="Enter title"
                                                                   value="{{ $form->translate($locale)->canonical_url ?? '' }}"
                                                                   class="form-control" />
                                                        </div>

                                                        <div class="form-group col-md-6">
                                                            <label for="meta_description"> Meta Description {{ $locale }}</label>

                                                            <textarea id="meta_description"
                                                                      name="{{ $locale }}[meta_description]"
                                                                      class="form-control"
                                                                      rows="10">{{ $form->translate($locale)->meta_description ?? '' }}</textarea>
                                                        </div>

                                                        <div class="form-group col-md-6">
                                                            <label for="meta_keywords"> Meta Keywords {{ $locale }}</label>

                                                            <textarea id="meta_keywords"
                                                                      name="{{ $locale }}[meta_keywords]"
                                                                      class="form-control"
                                                                      rows="10">{{ $form->translate($locale)->meta_keywords ?? '' }}</textarea>
                                                        </div>

                                                        <div class="form-group col-md-12">
                                                            <label for="alt_image"> Alt image {{ $locale }} </label>

                                                            <input type="text"
                                                                   id="alt_image"
                                                                   name="{{ $locale }}[alt_image]"
                                                                   placeholder="Enter title"
                                                                   value="{{ $form->translate($locale)->alt_image ?? '' }}"
                                                                   class="form-control" />
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach

                                        </div>
                                    </div>
                                    <div class="header-left mt-2 mb-2 col-md-12" style="border: dashed;background-color: #e3e3e387;">
                                        <div class="dashboard_bar ml-2 mt-2">
                                        Images Required
                                        </div>
                                    </div>
                                    <div class="form-group col-md-6 mt-2 @error('image') has-danger @enderror">
                                        <label class="font-bold">Image <span class="text-danger">*</span></label>
                                        <input type="file" name="image" class="dropify" data-height="200" data-default-file="{{ $form->image }}"/>
                                        @if($errors->has('image'))
                                            <span class="text-danger">{{ $errors->first('image') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group col-md-6 mt-2 @error('cover_image') has-danger @enderror">
                                        <label class="font-bold">Cover Image </label>
                                        <input type="file" name="cover_image" class="dropify" data-height="200" data-default-file=" {{ $form->cover_image ?? ''}}"/>
                                        @if($errors->has('cover_image'))
                                            <span class="text-danger">{{ $errors->first('cover_image') }}</span>
                                        @endif
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
@section('back-scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"></script>
<script>
    $('.dropify').dropify();
</script>
@endsection
