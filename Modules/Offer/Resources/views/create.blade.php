@extends('admin.layout.base')

@section('title')
    Create a new Offer
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="basic-form">
                            <form class="form" method="POST" enctype="multipart/form-data" action="{{ route('admin.offers.store') }}">
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
                                                    <div class="pt-4 row">
                                                        <!-- @include('admin.layout.field', field('text', $locale.'[name]', 'Name', 6, [], ['key' => 'name'])) -->
                                                        <div class="form-group bmd-form-group col-md-6 @error("$locale.name") has-danger @enderror">
                                                            <label for="name_id"> Name {{ $locale }} <span class="text-danger">*</span></label>
                                                            <input type="text" id="name_id" name="{{ $locale }}[name]" placeholder="Enter name" value="{{ old("$locale.name") }}" class="form-control" />

                                                            @error("$locale.name")
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
                                                                   value="{{ old("$locale.meta_title") }}"
                                                                   class="form-control" />
                                                        </div>

                                                        <div class="form-group col-md-12">
                                                            <label for="canonical_url"> Canonical Url {{ $locale }} </label>

                                                            <input type="text"
                                                                   id="canonical_url"
                                                                   name="{{ $locale }}[canonical_url]"
                                                                   placeholder="Enter title"
                                                                   value="{{ old("$locale.canonical_url") }}"
                                                                   class="form-control" />
                                                        </div>

                                                        <div class="form-group col-md-6">
                                                            <label for="meta_description"> Meta Description {{ $locale }}</label>

                                                            <textarea id="meta_description"
                                                                      name="{{ $locale }}[meta_description]"
                                                                      class="form-control"
                                                                      rows="10">{{ old("$locale.meta_description") }}</textarea>
                                                        </div>

                                                        <div class="form-group col-md-6">
                                                            <label for="meta_keywords"> Meta Keywords {{ $locale }}</label>

                                                            <textarea id="meta_keywords"
                                                                      name="{{ $locale }}[meta_keywords]"
                                                                      class="form-control"
                                                                      rows="10">{{ old("$locale.meta_keywords") }}</textarea>
                                                        </div>

                                                        <div class="form-group col-md-12">
                                                            <label for="alt_image"> Alt image {{ $locale }} </label>

                                                            <input type="text"
                                                                   id="alt_image"
                                                                   name="{{ $locale }}[alt_image]"
                                                                   placeholder="Enter title"
                                                                   value="{{ old("$locale.alt_image") }}"
                                                                   class="form-control" />
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach

                                        </div>
                                    </div>
                                    <div class="header-left mt-2 mb-2 col-md-12" style="border: dashed;background-color: #e3e3e387;">
                                        <div class="dashboard_bar ml-2 mt-2">
                                        Offer Info
                                        </div>
                                    </div>
                                    <!-- @include('admin.layout.field', field('text', 'price', 'Price', 4)) -->
                                    <div class="form-group col-md-4 @error("price") has-danger @enderror">
                                        <label for="price_id"> Price <span class="text-danger">*</span></label>
                                        <input type="text" id="price_id" name="price" placeholder="Enter Price" value="{{ old("price") }}" class="form-control" />

                                        @error("price")
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <!-- @include('admin.layout.field', field('select', 'service_id', 'Service', 4, [], $services)) -->
                                    <div class="form-group col-md-4 @error('service_id') has-danger @enderror">
                                            <label for="service_id">Service<span style="color: red">*</span></label>
                                            <select class="custom-select form-control city-type" id="service_id" name="service_id">
                                                <option value="">-- Select --</option>
                                                @if(!empty($services))
                                                    @foreach($services as $service)
                                                    <option value="{{$service->id}}" {{ old('service_id') == $service->id ? 'selected' : '' }}>{{$service->name}}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                            @if($errors->has('service_id'))
                                                <span class="text-danger">{{ $errors->first('service_id') }}</span>
                                            @endif
                                    </div>
                                    <!-- @include('admin.layout.field', field('select', 'branche_id', 'Offer Branches', 4, [], $branches)) -->
                                    <div class="form-group col-md-4 @error('branche_id') has-danger @enderror">
                                            <label for="branche_id">Offer City<span style="color: red">*</span></label>
                                            <select class="custom-select form-control city-type" id="branche_id" name="branche_id">
                                                <option value="">-- Select --</option>
                                                @if(!empty($branches))
                                                    @foreach($branches as $branche)
                                                    <option value="{{$branche->id}}" {{ old('branche_id') == $branche->id ? 'selected' : '' }}>{{$branche->name}}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                            @if($errors->has('branche_id'))
                                                <span class="text-danger">{{ $errors->first('branche_id') }}</span>
                                            @endif
                                    </div>

                                    <div class="form-group col-md-4">
                                            <label for="status_payment">OnlinePayment Options<span style="color: red">*</span></label>
                                            <select class="custom-select form-control" name="status_payment" required>
                                                <option value="0" {{ old('status_payment') == '0' ? 'selected' : '' }}>Show</option>
                                                <option value="1" {{ old('status_payment') == '1' ? 'selected' : '' }}>Hidden</option>
                                            </select>
                                    </div>
                                    <div class="form-group col-md-4">
                                            <label for="status_installment">InstallmentPayment Options<span style="color: red">*</span></label>
                                            <select class="custom-select form-control" name="status_installment" required>
                                                <option value="0" {{ old('status_installment') == '0' ? 'selected' : '' }}>Show</option>
                                                <option value="1" {{ old('status_installment') == '1' ? 'selected' : '' }}>Hidden</option>
                                            </select>
                                    </div>
                                    <div class="form-group col-md-4">
                                    </div>

                                    <div class="form-group col-md-6 mt-3 mb-4">
                                       <label for="sections"> Offer Branches</label>
                                        <select class="form-control js-example-basic-multiple" id="branches" name="branche[]" multiple="multiple">
                                              <option value="">-- Select --</option>
                                            @if(!empty($Listbranches))
                                                @foreach($Listbranches as $branche)
                                                <option value="{{$branche->id}}">{{$branche->name}}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                    <div class="form-group col-md-6 mt-3 mb-4">
                                        <label for="sections"> Pages From LP</label>
                                        <select class="form-control js-example-basic-multiple" name="pages[]" multiple="multiple">
                                            <option value="">-- Select --</option>
                                            @if(!empty($GetALlPages))
                                                @foreach($GetALlPages as $pages)
                                                <option value="{{$pages['id']}}">{{$pages['name']}}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                    <!-- @include('admin.layout.field', field('file', 'image', 'Image', 12)) -->
                                    <div class="form-group col-md-6 @error('image') has-danger @enderror">
                                        <label class="font-bold">Image <span class="text-danger">*</span></label>
                                        <input type="file" name="image" class="dropify" data-height="200" data-default-file=""/>
                                        @if($errors->has('image'))
                                            <span class="text-danger">{{ $errors->first('image') }}</span>
                                        @endif
                                    </div>
                                    <!-- @include('admin.layout.field', field('file', 'slider_image', 'Slider Image', 12)) -->
                                    <div class="form-group col-md-6 @error('slider_image') has-danger @enderror">
                                        <label class="font-bold">Slider Image </label>
                                        <input type="file" name="slider_image" class="dropify" data-height="200" data-default-file=""/>
                                        @if($errors->has('slider_image'))
                                            <span class="text-danger">{{ $errors->first('slider_image') }}</span>
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