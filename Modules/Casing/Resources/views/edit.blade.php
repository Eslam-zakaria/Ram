@extends('admin.layout.base')

@section('title')
Edit a Casing
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="basic-form">
                        <form class="form" method="POST" enctype="multipart/form-data"
                            action="{{ route('admin.Casings.update', ['Casing' => $form->id]) }}">
                            @method('PUT')
                            @csrf

                            <div class="form-row " style="margin-bottom:  10px">
                                <!-- @include('admin.layout.field', field('file', 'image_before', 'Image Before', 12)) -->
                                <div class="form-group col-md-6 @error('image_before') has-danger @enderror">
                                    <label class="font-bold">Before image <span class="text-danger">*</span></label>
                                    <input type="file" name="image_before" class="dropify" data-height="200"
                                        data-default-file="{{ $form->image_before }}" />
                                    @if($errors->has('image_before'))
                                    <span class="text-danger">{{ $errors->first('image_before') }}</span>
                                    @endif
                                </div>
                                <!-- @include('admin.layout.field', field('file', 'image_after', 'Image After', 12)) -->
                                <div class="form-group col-md-6 @error('image_after') has-danger @enderror">
                                    <label class="font-bold">After image <span class="text-danger">*</span></label>
                                    <input type="file" name="image_after" class="dropify" data-height="200"
                                        data-default-file="{{ $form->image_after }}" />
                                    @if($errors->has('image_after'))
                                    <span class="text-danger">{{ $errors->first('image_after') }}</span>
                                    @endif
                                </div>
                                <!-- @include('admin.layout.field', field('select', 'doctor_id', 'Doctor', 6, [], $categories)) -->
                                <div class="form-group col-md-6 @error('doctor_id') has-danger @enderror">
                                    <label for="doctor_id">Doctor<span style="color: red">*</span></label>
                                    <select class="custom-select form-control city-type" id="doctor_id"
                                        name="doctor_id">
                                        <option value="">-- Select --</option>
                                        @if(!empty($doctors))
                                        @foreach($doctors as $doctor)
                                        <option value="{{$doctor->id}}"
                                            {{ $form->doctor_id == $doctor->id ? 'selected' : '' }}>{{$doctor->name}}
                                        </option>
                                        @endforeach
                                        @endif
                                    </select>
                                    @if($errors->has('doctor_id'))
                                    <span class="text-danger">{{ $errors->first('doctor_id') }}</span>
                                    @endif
                                </div>
                                <!-- @include('admin.layout.field', field('select', 'category_id', 'Category', 6, [], $categories)) -->

                                <div class="form-group col-md-6 @error('category_id') has-danger @enderror">
                                    <label for="category_id">Category<span style="color: red">*</span></label>
                                    <select class="custom-select form-control city-type" id="category_id"
                                        name="category_id">
                                        <option value="">-- Select --</option>
                                        @if(!empty($categories))
                                        @foreach($categories as $category)
                                        <option value="{{$category->id}}"
                                            {{ $form->category_id == $category->id ? 'selected' : '' }}>
                                            {{$category->name}}</option>
                                        @endforeach
                                        @endif
                                    </select>
                                    @if($errors->has('category_id'))
                                    <span class="text-danger">{{ $errors->first('category_id') }}</span>
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
@section('back-scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"></script>
<script>
    $('.dropify').dropify();
</script>
@endsection
@section('scripts')
@parent
<script src="https://cdn.tiny.cloud/1/p8qrxaclma2ob8l9s8vx7xzkjcmufythoqzuw9hyw9l6dnwo/tinymce/5/tinymce.min.js"
    referrerpolicy="origin"></script>

<script type="text/javascript">
    tinymce.init({
        selector: '.desciption textarea',
        plugins: ' media link',
        height: 350,
    });

</script>
@endsection
