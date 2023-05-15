@extends('admin.layout.base')

@section('title')
    Edit a Discount Category ({{ $form->name }})
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="basic-form">
                            <form class="form" method="POST" enctype="multipart/form-data" action="{{ route('admin.discount-categories.update', ['discount_category' => $form->id]) }}">
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

                                                        <div class="form-group col-md-6 @error("$locale.name") has-danger @enderror">
                                                            <label for="name_id"> Name {{ $locale }} <span style="color: red">*</span></label>
                                                            <input type="text" id="name_id" name="{{ $locale }}[name]" placeholder="Enter name" value="{{ $form->translate($locale)->name }}" class="form-control" />

                                                            @error("$locale.name")
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>

                                                    </div>
                                                </div>
                                            @endforeach
                                            <!-- @include('admin.layout.field', field('text', 'slug', 'Slug', 6, $form, ['key' => 'slug'])) -->
                                            <div class="form-group col-md-6 @error('slug') has-danger @enderror">
                                                <label for="price_id"> slug<span class="text-danger">*</span></label>
                                                <input type="text" id="price_id" name="slug" placeholder="Enter slug" value="{{ $form->slug }}" class="form-control" />

                                                @error('slug')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>

                                        </div>
                                    </div>
                                </div>

                                <div class="form-group col-md-12 bmd-form-group mt-3 vend">
                                    <label for="sections"> Branches<span style="color: red">*</span></label>
                                    <select class="form-control js-example-basic-multiple" id="branches" name="branche_id[]" multiple="multiple">
                                    <option value="">-- Select --</option>
                                    @foreach($branches as $key => $value)
                                    <option value="{{$key}}" @if(in_array($key, $discountBranchesIds)) selected @endif>{{$value}}</option>
                                    @endforeach
                                    </select>
                                    @error('branche_id')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <!-- @include('admin.layout.field', field('select', 'branche_id', 'Branches', 12, $form, $branches, true, true)) -->

                                <button type="submit" class="btn btn-primary pull-right mt-3">Save</button>
                                <button type="button" onclick="parent.history.back();" class="btn btn-danger mt-3">Back</button>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
