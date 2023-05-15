
@extends('admin.layout.base')

@section('title')
    Create a new Job
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="basic-form">
                            <form class="form" method="POST" enctype="multipart/form-data" action="{{ route('admin.jobs.store') }}">
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
                                                        <div class="form-group bmd-form-group col-md-6 @error("$locale.name") has-danger @enderror">
                                                            <label for="name_id"> Name {{ $locale }} <span class="text-danger">*</span></label>
                                                            <input type="text" id="name_id" name="{{ $locale }}[name]" placeholder="Enter name" value="{{ old("$locale.name") }}" class="form-control" />

                                                            @error("$locale.name")
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                        <!-- @include('admin.layout.field', field('textarea', $locale.'[content]', 'Content', 6, [], ['key' => 'content'])) -->
                                                        <div class="form-group bmd-form-group col-md-6 @error("$locale.content") has-danger @enderror">
                                                            <label for="content_id"> Content {{ $locale }} <span class="text-danger">*</span></label>
                                                            <textarea id="content_name" name="{{ $locale }}[content]" value="{{ old("$locale.content") }}" class="form-control" rows="10"></textarea>

                                                            @error("$locale.content")
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                        <!-- @include('admin.layout.field', field('textarea', $locale.'[description]', 'Description', 6, [], ['key' => 'description'])) -->
                                                        <div class="form-group bmd-form-group col-md-6 @error("$locale.description") has-danger @enderror">
                                                            <label for="description_id"> Description {{ $locale }} <span class="text-danger">*</span></label>
                                                            <textarea id="description_name" name="{{ $locale }}[description]" value="{{ old("$locale.description") }}" class="form-control" rows="10"></textarea>

                                                            @error("$locale.description")
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                        <!-- @include('admin.layout.field', field('textarea', $locale.'[requirements]', 'Requirements', 6, [], ['key' => 'requirements'])) -->
                                                        <div class="form-group bmd-form-group col-md-6 @error("$locale.requirements") has-danger @enderror">
                                                            <label for="description_id"> Requirements {{ $locale }} <span class="text-danger">*</span></label>
                                                            <textarea id="description_name" name="{{ $locale }}[requirements]" value="{{ old("$locale.requirements") }}" class="form-control" rows="10"></textarea>

                                                            @error("$locale.requirements")
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach

                                        </div>
                                    </div>
                                     <!-- @include('admin.layout.field', field('select', 'branche_id', 'Branch', 6, [], $branches)) -->
                                    <div class="form-group col-md-6 mt-3 @error('branche_id') has-danger @enderror">
                                            <label for="branche_id">Branch<span style="color: red">*</span></label>
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
                                    <!-- @include('admin.layout.field', field('select', 'department_id', 'Department', 6, [], $departments)) -->
                                    <div class="form-group col-md-6 mt-3 @error('department_id') has-danger @enderror">
                                            <label for="department_id">Department<span style="color: red">*</span></label>
                                            <select class="custom-select form-control city-type" id="department_id" name="department_id">
                                                <option value="">-- Select --</option>
                                                @if(!empty($departments))
                                                    @foreach($departments as $depart)
                                                    <option value="{{$depart->id}}" {{ old('department_id') == $depart->id ? 'selected' : '' }}>{{$depart->name}}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                            @if($errors->has('department_id'))
                                                <span class="text-danger">{{ $errors->first('department_id') }}</span>
                                            @endif
                                    </div>
                                </div>

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
