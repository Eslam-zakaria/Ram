@extends('admin.layout.base')

@section('title')
    Create a new Branche
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="basic-form">
                            <form class="form" method="POST" enctype="multipart/form-data" action="{{ route('admin.branches.store') }}">
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
                                                        <!-- @include('admin.layout.field', field('text', $locale.'[name]', 'Name', 6, [], ['key' => 'name'])) -->
                                                        <div class="form-group col-md-6 @error("$locale.name") has-danger @enderror">
                                                            <label for="name_id"> Name {{ $locale }} <span class="text-danger">*</span></label>
                                                            <input type="text" id="name_id" name="{{ $locale }}[name]" placeholder="Enter name" value="{{ old("$locale.name") }}" class="form-control" />

                                                            @error("$locale.name")
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach

                                        </div>

                                    </div>

                                    <!-- @include('admin.layout.field', field('select', 'country_id', 'City', 3, [], $countries)) -->
                                    <div class="form-group col-md-4 @error('country_id') has-danger @enderror">
                                            <label for="country_id">City<span style="color: red">*</span></label>
                                            <select class="custom-select form-control city-type" id="country_id" name="country_id">
                                                <option value="">-- Select --</option>
                                                @if(!empty($countries))
                                                    @foreach($countries as $depart)
                                                    <option value="{{$depart->id}}" {{ old('country_id') == $depart->id ? 'selected' : '' }}>{{$depart->name}}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                            @if($errors->has('country_id'))
                                                <span class="text-danger">{{ $errors->first('country_id') }}</span>
                                            @endif
                                    </div>
                                    <!-- @include('admin.layout.field', field('text', 'phone', 'Phone', 3)) -->
                                    <div class="form-group col-md-4 @error("phone") has-danger @enderror">
                                        <label for="phone"> Phone<span class="text-danger">*</span></label>
                                        <input type="text" id="phone" name="phone" placeholder="Enter phone" value="{{ old("phone") }}" class="form-control" />

                                        @error("phone")
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="reference_id"> BrancheList ID</label>
                                        <input type="text" name="reference_id" placeholder="Enter Branche ID" value="{{ old("reference_id") }}" class="form-control" />
                                    </div>
                                    <!-- @include('admin.layout.field', field('text', 'location', 'Location', 6)) -->
                                    <div class="form-group col-md-6 @error("location") has-danger @enderror">
                                        <label for="location"> Location<span class="text-danger">*</span></label>
                                        <input type="text" id="location" name="location" placeholder="Enter name" value="{{ old("location") }}" class="form-control" />

                                        @error("location")
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-6 mt-3">
                                        <label for="sections"> Services</label>
                                        <select class="form-control js-example-basic-multiple" id="services" name="service[]" multiple="multiple">
                                        <option value="">-- Select --</option>
                                            @if(!empty($services))
                                                @foreach($services as $serv)
                                                <option value="{{$serv->id}}" {{ old('service[]') == $serv->id ? 'selected' : '' }}>{{$serv->name}}</option>
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

