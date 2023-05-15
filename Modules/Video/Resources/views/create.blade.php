@extends('admin.layout.base')

@section('title')
    Create a new Videos
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="basic-form">
                            <form class="form" method="POST" enctype="multipart/form-data" action="{{ route('admin.videos.store') }}">
                                @method('POST')
                                @csrf

                                <div class="form-row mb-5" style="margin-bottom:  10px">
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
                                                        <!-- @include('admin.layout.field', field('textarea', $locale.'[description]', 'Description', 6, [], ['key' => 'description'])) -->
                                                        <div class="form-group bmd-form-group col-md-6 @error("$locale.name") has-danger @enderror">
                                                            <label for="input_name"> Name {{ $locale }} <span class="text-danger">*</span></label>
                                                            <input type="text" id="input_name" name="{{ $locale }}[name]" placeholder="Enter name" value="{{ old("$locale.name") }}" class="form-control" />
                                                            @error("$locale.name")
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach

                                        </div>
                                    </div>
                                    <!-- @include('admin.layout.field', field('select', 'doctor_id', 'Doctor', 6, [], $doctors)) -->
                                    <div class="form-group col-md-6 mt-3 @error('doctor_id') has-danger @enderror">
                                           <label for="doctor_id">Doctor<span style="color: red">*</span></label>
                                            <select class="form-control" id="doctor_id" name="doctor_id">
                                                <option value="">-- Select --</option>
                                                @if(!empty($doctors))
                                                    @foreach($doctors as $doctor)
                                                    <option value="{{$doctor->id}}" {{ old('doctor_id') == $doctor->id ? 'selected' : '' }}>{{$doctor->name}}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                            @if($errors->has('doctor_id'))
                                                <span class="text-danger">{{ $errors->first('doctor_id') }}</span>
                                            @endif
                                    </div>
                                    <div class="form-group col-md-6">
                                    </div>
                                    <div class="form-group col-md-6 @error('img') has-danger @enderror">
                                        <label class="font-bold">Video image <span class="text-danger">*</span></label>
                                        <input type="file" name="image" class="dropify" data-height="200" data-default-file=""/>
                                        @if($errors->has('image'))
                                            <span class="text-danger">{{ $errors->first('image') }}</span>
                                        @endif
                                    </div>
                                    @include('admin.layout.field', field('file', 'video', 'Video', 12))
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
