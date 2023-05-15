@extends('admin.layout.base')

@section('title')
    Create a new Doctor
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="basic-form">
                            <form class="form" method="POST" enctype="multipart/form-data" action="{{ route('admin.doctors.store') }}">
                                @method('POST')
                                @csrf

                                <div class="form-row" style="margin-bottom:  10px">
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
                                                        <div class="form-group bmd-form-group col-md-6 @error("$locale.name") has-danger @enderror">
                                                            <label for="name_id"> Name {{ $locale }} <span class="text-danger">*</span></label>
                                                            <input type="text" id="name_id" name="{{ $locale }}[name]" placeholder="Enter name" value="{{ old("$locale.name") }}" class="form-control" />

                                                            @error("$locale.name")
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                        <div class="form-group bmd-form-group col-md-6 @error("$locale.slug") has-danger @enderror">
                                                            <label for="select_page_id"> Slug {{ $locale }} <span class="text-danger">*</span></label>
                                                            <input type="text" id="input_page_name" name="{{ $locale }}[slug]" placeholder="Enter slug" value="{{ old("$locale.slug") }}" class="form-control" />

                                                            @error("$locale.slug")
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                        <!-- @include('admin.layout.field', field('textarea', $locale.'[description]', 'Brief', 6, [], ['key' => 'description'])) -->
                                                        <div class="form-group bmd-form-group col-md-6 @error("$locale.description") has-danger @enderror">
                                                            <label for="select_page_id"> Brief {{ $locale }} <span class="text-danger">*</span></label>
                                                            <textarea id="input_page_name" name="{{ $locale }}[description]" class="form-control" rows="10">{{ old("$locale.description") }}</textarea>

                                                            @error("$locale.description")
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                        <!-- @include('admin.layout.field', field('textarea', $locale.'[bio]', 'Bio', 6, [], ['key' => 'bio'])) -->
                                                        <div class="form-group bmd-form-group col-md-6 @error("$locale.bio") has-danger @enderror">
                                                            <label for="select_page_id"> Bio {{ $locale }} <span class="text-danger">*</span></label>
                                                            <textarea id="input_page_name" name="{{ $locale }}[bio]" class="form-control" rows="10">{{ old("$locale.bio") }}</textarea>

                                                            @error("$locale.bio")
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                        <div class="header-left mt-2 mb-2" style="border: dashed;background-color: #e3e3e387;">
                                                            <div class="dashboard_bar ml-2">
                                                                Seo Details {{ $locale }}
                                                            </div>
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label for="meta_title"> Meta Title {{ $locale }} </label>
                                                            <input type="text" id="meta_title" name="{{ $locale }}[meta_title]" placeholder="Enter title" value="{{ old("$locale.meta_title") }}" class="form-control" />
                                                        </div>
                                                        <!-- @include('admin.layout.field', field('text', $locale.'[canonical_url]', 'Canonical Url', 6, [], ['key' => 'canonical_url'])) -->
                                                        <div class="form-group col-md-6">
                                                            <label for="canonical_url"> Canonical Url {{ $locale }} </label>
                                                            <input type="text" id="canonical_url" name="{{ $locale }}[canonical_url]" placeholder="Enter title" value="{{ old("$locale.canonical_url") }}" class="form-control" />
                                                        </div>
                                                        <!-- @include('admin.layout.field', field('textarea', $locale.'[meta_description]', 'Meta Description', 6, [], ['key' => 'meta_description'])) -->
                                                        <div class="form-group col-md-6">
                                                            <label for="meta_description"> Meta Description {{ $locale }}</label>
                                                            <textarea id="meta_description" name="{{ $locale }}[meta_description]" class="form-control" rows="10">{{ old("$locale.meta_description") }}</textarea>
                                                        </div>
                                                        <!-- @include('admin.layout.field', field('textarea', $locale.'[meta_keywords]', 'Meta Keywords', 6, [], ['key' => 'meta_keywords'])) -->
                                                        <div class="form-group col-md-6">
                                                            <label for="meta_keywords"> Meta Keywords {{ $locale }}</label>
                                                            <textarea id="meta_keywords" name="{{ $locale }}[meta_keywords]" class="form-control" rows="10">{{ old("$locale.meta_keywords") }}</textarea>
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label for="alt_image"> Alt image {{ $locale }} </label>
                                                            <input type="text" id="alt_image" name="{{ $locale }}[alt_image]" placeholder="Enter title" value="{{ old("$locale.alt_image") }}" class="form-control" />
                                                        </div>
                                                        <hr style="border-top: 6px solid rgba(0, 0, 0, 0.47);">
                                                    </div>
                                                </div>
                                            @endforeach

                                        </div>
                                    </div>
                                    @include('admin.layout.field', field('text','years_of_experience', 'Years Of Experience', 6, [], ['key' => 'years_of_experience']))
                                    <div class="form-group col-md-3 mt-3  bmd-form-gtroup @error('start_time') has-danger @enderror">
                                        <label for="Specialities"> Shift Start Time</label>
                                        <br>
                                        <input type="time"  name="start_time">
                                        @if($errors->has('start_time'))
                                            <span class="text-danger">{{ $errors->first('start_time') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group col-md-3 mt-3 bmd-form-gtroup @error('end_time') has-danger @enderror">
                                        <label for="Specialities"> Shift End  Time</label>
                                        <br>
                                        <input type="time"  name="end_time">
                                        @if($errors->has('end_time'))
                                            <span class="text-danger">{{ $errors->first('end_time') }}</span>
                                        @endif
                                    </div>
                                    <div id="cities" class="form-group col-md-12 bmd-form-group mt-3 @error('country_id') has-danger @enderror">
                                           <label for="country_id">Countries/Cities<span style="color: red">*</span></label>
                                            <select class="custom-select form-control city-type" id="country_id" name="country_id">
                                                <option value="" data-id="">-- Select --</option>
                                                @if(!empty($countries))
                                                    @foreach($countries as $coun)
                                                    <option value="{{$coun->id}}" {{ old('country_id') == $coun->id ? 'selected' : '' }} data-id="vend-{{$coun->id}}">{{$coun->name}}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                            @if($errors->has('country_id'))
                                                <span class="text-danger">{{ $errors->first('country_id') }}</span>
                                            @endif
                                    </div>

                                    <div class="form-group col-md-6 bmd-form-group mt-3 vend">
                                        <label for="sections"> Branches</label>
                                        <select class="form-control js-example-basic-multiple" id="branches" name="branche[]" multiple="multiple">
                                        <option value="">-- Select --</option>
                                            
                                        </select>
                                    </div>
                                 
                                    <div id="specialti" class="form-group col-md-12 bmd-form-group mt-3 @error('specialty_id') has-danger @enderror">
                                           <label for="country_id">Specialization<span style="color: red">*</span></label>
                                            <select class="custom-select form-control specialty-type" id="specialty_id" name="specialty_id">
                                                <option value="" data-id="">-- Select --</option>
                                                @if(!empty($services))
                                                    @foreach($services as $serv)
                                                    <option value="{{$serv->id}}" {{ old('specialty_id') == $serv->id ? 'selected' : '' }} data-id="vend-{{$serv->id}}">{{$serv->name}}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                            @if($errors->has('specialty_id'))
                                                <span class="text-danger">{{ $errors->first('specialty_id') }}</span>
                                            @endif
                                    </div>

                                    <div class="form-group col-md-6 bmd-form-group mt-3 vend2">
                                        <label for="sections"> Specialties</label>
                                        <select class="form-control js-example-basic-multiple" id="specialties" name="specificity[]" multiple="multiple">
                                        <option value="">-- Select --</option>
                                            
                                        </select>
                                    </div>
                                    <!-- @include('admin.layout.field', field('file', 'image', 'Main Image (562px x 400px)', 12)) -->
                                    <br>
                                    <div class="form-group col-md-6 @error('image') has-danger @enderror">
                                        <label class="font-bold">Main image <span class="text-danger">*</span></label>
                                        <input type="file" name="image" class="dropify" data-height="200" data-default-file=""/>
                                        @if($errors->has('image'))
                                            <span class="text-danger">{{ $errors->first('image') }}</span>
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
<script>
        $(document).ready(function(){
            $(".city-type").change(function(){
                $(this).find("option:selected").each(function(){
                    var optionValue = $(this).attr("data-id");

                    if(optionValue){
                        $(".vend").show(2000);
                        $( "#cities" ).removeClass( "form-group col-md-12 bmd-form-group mt-3" ).addClass( "form-group col-md-6 bmd-form-group mt-3" );
                        $("#branches").attr('disabled',false).attr('required',true);

                    }else{
                        $(".vend").hide(2000);
                        $( "#cities" ).removeClass( "form-group col-md-6 bmd-form-group mt-3" ).addClass( "form-group col-md-12 bmd-form-group mt-3" );
                        $("#branches").attr('disabled',true).attr('required',false);
                    }
                });
            });
            $(".vend").hide();
            $("#branches").attr('disabled',true).attr('required',false);

            $(".specialty-type").change(function(){
                $(this).find("option:selected").each(function(){
                    var optionValue2 = $(this).attr("data-id");

                    if(optionValue2){
                        $(".vend2").show(2000);
                        $( "#specialti" ).removeClass( "form-group col-md-12 bmd-form-group mt-3" ).addClass( "form-group col-md-6 bmd-form-group mt-3" );
                        $("#specialties").attr('disabled',false).attr('required',true);

                    }else{
                        $(".vend2").hide(2000);
                        $( "#specialti" ).removeClass( "form-group col-md-6 bmd-form-group mt-3" ).addClass( "form-group col-md-12 bmd-form-group mt-3" );
                        $("#specialties").attr('disabled',true).attr('required',false);
                    }
                });
            });
            $(".vend2").hide();
            $("#specialties").attr('disabled',true).attr('required',false);
        });
</script>
    <script type="text/javascript">
        $("select[name='country_id']").change(function () {
            var country_id = $(this).val();
            var token = $("input[name='_token']").val();
            $.ajax({
                url: "<?php echo Url('/admin/ajax-BranchByCountryId') ?>",
                method: 'get',
                data: {
                    country_id: country_id,
                    _token: token
                },
                success: function (data) {
                    var myBranches = $('select[name="branche[]"]');
                      myBranches.find('option').remove();
                    if (data.status != 401) {
                        myBranches.append('<option value="">-- Select --</option>');
                        $.each(data.data, function (key, val) {
                            myBranches.append('<option value="' + val.id + '">' + val.name + '</option>');
                        });
                    } else {
                        myBranches.append('<option value="">-- No Data Fetch --</option>');
                        // myBranches.prop('disabled', true);
                    }
                }
            });
        });
        $("select[name='specialty_id']").change(function () {
            var specialty_id = $(this).val();
            var token = $("input[name='_token']").val();
            $.ajax({
                url: "<?php echo Url('/admin/ajax-SpecificityById') ?>",
                method: 'get',
                data: {
                    specialty_id: specialty_id,
                    _token: token
                },
                success: function (data) {
                    var mySpecialties = $('select[name="specificity[]"]');
                      mySpecialties.find('option').remove();
                    if (data.status != 401) {
                        mySpecialties.append('<option value="">-- Select --</option>');
                        $.each(data.data, function (key, val) {
                            mySpecialties.append('<option value="' + val.id + '">' + val.name + '</option>');
                        });
                    } else {
                        mySpecialties.append('<option value="">-- No Data Fetch --</option>');
                        // myBranches.prop('disabled', true);
                    }
                }
            });
        });
</script>
@endsection

