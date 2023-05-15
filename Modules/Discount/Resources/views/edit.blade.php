@extends('admin.layout.base')

@section('title')
    Edit a Discount ({{ $form->name }})
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="basic-form">
                            <form class="form" method="POST" enctype="multipart/form-data" action="{{ route('admin.discounts.update', ['discount' => $form->id]) }}">
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
                                                        <!-- @include('admin.layout.field', field('text', $locale.'[description]', 'description', 6, $form->translate($locale), ['key' => 'description'])) -->
                                                        <!-- @include('admin.layout.field', field('text', 'price', 'Price', 6, $form, ['key' => 'price'])) -->

                                                    </div>
                                                </div>
                                            @endforeach

                                        </div>
                                    </div>
                                    <!-- @include('admin.layout.field', field('select', 'card_id', 'Cards', 12, $form, $cards, true))
                                    @include('admin.layout.field', field('select', 'category_id', 'Category', 12, $form, $categories, true)) -->
                                    <div class="form-group col-md-6 @error('price') has-danger @enderror">
                                        <label for="price_id"> Price<span class="text-danger">*</span></label>
                                        <input type="text" id="price_id" name="price" placeholder="Enter price" value="{{ $form->price }}" class="form-control" />

                                        @error('price')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-6">
                                    </div>

                                    <div class="form-group col-md-6 mt-3 @error('card_id') has-danger @enderror">
                                           <label for="card_id">Cards<span style="color: red">*</span></label>
                                            <select class="custom-select form-control city-type" id="card_id" name="card_id">
                                                <option value="">-- Select --</option>
                                                @if(!empty($cards))
                                                    @foreach($cards as $card)
                                                    <option value="{{$card->id}}" {{ $form->card_id == $card->id ? 'selected' : '' }}>{{$card->name}}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                            @if($errors->has('card_id'))
                                                <span class="text-danger">{{ $errors->first('card_id') }}</span>
                                            @endif
                                    </div>

                                    <!-- @include('admin.layout.field', field('select', 'category_id', 'Category', 12, [], $categories, true)) -->
                                    <div class="form-group col-md-6 mt-3 @error('category_id') has-danger @enderror">
                                           <label for="category_id">Category<span style="color: red">*</span></label>
                                            <select class="custom-select form-control city-type" id="category_id" name="category_id">
                                                <option value="">-- Select --</option>
                                                @if(!empty($categories))
                                                    @foreach($categories as $cat)
                                                    <option value="{{$cat->id}}" {{ $form->category_id == $cat->id ? 'selected' : '' }}>{{$cat->name}}</option>
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

@section('scripts')
@parent
<script src="https://cdn.tiny.cloud/1/p8qrxaclma2ob8l9s8vx7xzkjcmufythoqzuw9hyw9l6dnwo/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>

<script type="text/javascript">
    tinymce.init({
        selector: '.desciption textarea',
        plugins: ' media link',
        height:350,
    });
</script>
@endsection

