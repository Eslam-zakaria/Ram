@extends('admin.layout.base')

@section('title')
    Create a new Sub Specificity
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="basic-form">
                            <form class="form" method="POST" enctype="multipart/form-data" action="{{ route('admin.categories.store') }}">
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
                                        <!-- @include('admin.layout.field', field('select', 'specificity_id', 'Specificities', 6, [], $specificities)) -->
                                        <div class="form-group col-md-6 mt-3 @error('specificity_id') has-danger @enderror">
                                            <label for="specificity_id">Service<span style="color: red">*</span></label>
                                            <select class="custom-select form-control city-type" id="specificity_id" name="specificity_id">
                                                <option value="">-- Select --</option>
                                                @if(!empty($specificities))
                                                    @foreach($specificities as $depart)
                                                    <option value="{{$depart->id}}" {{ old('specificity_id') == $depart->id ? 'selected' : '' }}>{{$depart->name}}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                            @if($errors->has('specificity_id'))
                                                <span class="text-danger">{{ $errors->first('specificity_id') }}</span>
                                            @endif
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
s
