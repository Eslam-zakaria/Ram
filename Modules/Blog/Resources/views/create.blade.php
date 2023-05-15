@extends('admin.layout.base')

@section('title', 'Create a new Blog')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="basic-form">
                            <form class="form" method="POST" enctype="multipart/form-data" action="{{ route('admin.blogs.store') }}">
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
                                                        <div class="form-group bmd-form-group col-md-12 @error("$locale.name") has-danger @enderror">
                                                            <label for="name_id"> Name {{ $locale }} @if($locale == 'ar')<span class="text-danger">*</span>@endif</label>

                                                            <input type="text"
                                                                   id="name_id"
                                                                   name="{{ $locale }}[name]"
                                                                   placeholder="Enter name"
                                                                   value="{{ old("$locale.name") }}"
                                                                   class="form-control" />

                                                            @error("$locale.name")
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>

                                                        <div class="form-group col-md-12 @error("$locale.slug") has-danger @enderror">
                                                            <label for="slug_id"> Slug {{ $locale }} @if($locale == 'ar')<span class="text-danger">*</span>@endif</label>

                                                            <input type="text"
                                                                   id="slug_id"
                                                                   name="{{ $locale }}[slug]"
                                                                   placeholder="Enter slug"
                                                                   value="{{ old("$locale.slug") }}"
                                                                   class="form-control" />

                                                            @error("$locale.slug")
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>

                                                        <div class="desciption col-md-12">
                                                            <div class="form-group col-md-12 @error("$locale.content") has-danger @enderror">
                                                                <label for="content_name"> Content {{ $locale }} @if($locale == 'ar')<span class="text-danger">*</span>@endif</label>

                                                                <textarea id="content_name"
                                                                          name="{{ $locale }}[content]"
                                                                          class="form-control"
                                                                          rows="10">{{ old("$locale.content") }}</textarea>

                                                                @error("$locale.content")
                                                                    <span class="text-danger">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                        </div>

                                                        <div class="header-left mt-2 mb-2 col-md-12" style="border: dashed;background-color: #e3e3e387;">
                                                            <div class="dashboard_bar ml-2">
                                                                Seo Details {{ $locale }}
                                                            </div>
                                                        </div>

                                                        <div class="form-group col-md-12">
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

                                                        <hr style="border-top: 6px solid rgba(0, 0, 0, 0.47);">
                                                    </div>
                                                </div>
                                            @endforeach

                                        </div>
                                    </div>
                                    <div class="form-group col-md-6 mt-3 @error('category_id') has-danger @enderror">
                                        <label for="category_id">Category<span style="color: red">*</span></label>

                                        <select class="custom-select form-control city-type" id="category_id" name="category_id">
                                            <option value="">-- Select --</option>
                                            @if(!empty($categories))
                                                @foreach($categories as $cat)
                                                    <option value="{{$cat->id}}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>{{$cat->name}}</option>
                                                @endforeach
                                            @endif
                                        </select>

                                        @if($errors->has('category_id'))
                                            <span class="text-danger">{{ $errors->first('category_id') }}</span>
                                        @endif
                                    </div>

                                    <div class="form-group col-md-6"></div>

                                    <div class="form-group col-md-6 @error('image') has-danger @enderror">
                                        <label class="font-bold">Main Image <span class="text-danger">*</span></label>

                                        <input type="file"
                                               name="image"
                                               class="dropify"
                                               data-height="200"
                                               data-default-file=""/>

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

@section('scripts')
    @parent
    <script src="https://cdn.tiny.cloud/1/p8qrxaclma2ob8l9s8vx7xzkjcmufythoqzuw9hyw9l6dnwo/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>


    <script type="text/javascript">
        tinymce.init({
            selector: '.desciption textarea',
            plugins: ' media link ,image code',
            height:350,
            toolbar: 'undo redo | image code',
            image_title: true,
            /* enable automatic uploads of images represented by blob or data URIs*/
            automatic_uploads: true,
            /*
                URL of our upload handler (for more details check: https://www.tiny.cloud/docs/configure/file-image-upload/#images_upload_url)
                images_upload_url: 'postAcceptor.php',
                here we add custom filepicker only to Image dialog
            */
            file_picker_types: 'image',
            /* and here's our custom image picker*/
            file_picker_callback: function (cb, value, meta) {
                var input = document.createElement('input');
                input.setAttribute('type', 'file');
                input.setAttribute('accept', 'image/*');

                /*
                Note: In modern browsers input[type="file"] is functional without
                even adding it to the DOM, but that might not be the case in some older
                or quirky browsers like IE, so you might want to add it to the DOM
                just in case, and visually hide it. And do not forget do remove it
                once you do not need it anymore.
                */

                input.onchange = function () {
                var file = this.files[0];

                var reader = new FileReader();
                reader.onload = function () {
                    /*
                    Note: Now we need to register the blob in TinyMCEs image blob
                    registry. In the next release this part hopefully won't be
                    necessary, as we are looking to handle it internally.
                    */
                    var id = 'blobid' + (new Date()).getTime();
                    var blobCache =  tinymce.activeEditor.editorUpload.blobCache;
                    var base64 = reader.result.split(',')[1];
                    var blobInfo = blobCache.create(id, file, base64);
                    blobCache.add(blobInfo);

                    /* call the callback and populate the Title field with the file name */
                    cb(blobInfo.blobUri(), { title: file.name });
                };
                reader.readAsDataURL(file);
                };

                input.click();
            },
        });
    </script>
@endsection
