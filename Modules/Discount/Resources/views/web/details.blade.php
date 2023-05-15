@extends('web.layouts.base')

@section('styles')
    <link rel="stylesheet preload" href="{{latest('/web/assets2/css/partners'.((app()->getLocale() == 'ar') ? '-rtl' : '').'.min.css')}}" as="style" crossorigin>
@endsection

@section('pageTitle')
{{ __('messages.Partners Discount') }} | {{ $card->name ? $card->name : '' }}
@endsection

@section('slug')
@if(app()->getLocale() == 'ar')
<li class="list-inline-item d-none d-xl-inline-block">
    <a href="{{ route(Route::currentRouteName(), array_replace(Route::getCurrentRoute()->parameters(), ['lang' =>'en'])) }}" class="lang">
        English
    </a>
</li>
@else
<li class="list-inline-item d-none d-xl-inline-block">
    <a href="{{ route(Route::currentRouteName(), array_replace(Route::getCurrentRoute()->parameters())) }}" class="lang">
        عربي
    </a>
</li>
@endif
@endsection

@section('lang-mobile')
@if(app()->getLocale() == 'ar')
<a href="{{ route(Route::currentRouteName(), array_replace(Route::getCurrentRoute()->parameters(), ['locale' =>'en'])) }}" class="d-xl-none lang">English</a>
@else
<a href="{{ route(Route::currentRouteName(), array_replace(Route::getCurrentRoute()->parameters())) }}" class="d-xl-none lang">عربي</a>
@endif
@endsection

@section('content')
    <!-- page header -->
    <div class="page-header">
        <div class="container">
            <!-- image -->
            <div class="page-header__image">
                <picture>
                    <source srcset="{{latest('/web/assets/images/page-header.webp')}}" type="image/webp">
                    <img src="{{latest('/web/assets/images/page-header.jpg')}}" draggable="false" alt="page image" data-aos="zoom-out">
                </picture>
            </div>
            <!-- // image -->
            <!-- title -->
            <h1 class="h3" data-aos="fade-up" data-aos-delay="100">
                {{ $card->name }}
            </h1>
            <!-- title -->
        </div>
    </div>
    <!-- // page header -->


    <!-- discount partners details -->
    <div class="discount-partners d-pad">
        <div class="container">
            <!-- title -->
            <div class="section-title">
                <h2 class="title" data-aos="fade-up">
                    {{ __("messages.Discounts") }} <span class="color">{{ $card->name }}</span>
                </h2>
                <p data-aos="fade-up" data-aos-delay="100">
                {{ settings()->get('titles.details.discounts.page') }}
                </p>
            </div>
            <!-- // title -->
            <div class="row">
                <!-- filters -->
                <div class="col-md-5 col-lg-4 col-xl-3">
                    <div class="filters" data-aos="fade-up">
                        <!-- filter -->
                        <div class="filters__bg" data-aos="fade-up">
                            <!-- image -->
                            <div class="discount-partner__image">
                                <picture>
                                    <source srcset="{{ $card->image }}" type="image/webp"><img
                                        src= "{{ $card->image }}" draggable="false" loading="lazy" alt="alt">
                                </picture>
                            </div>
                            <!-- // image -->
                            <div class="filter__btns">
                                <div class="nav flex-column nav-pills">
                                    @foreach($categories as $category)
                                        <a href="#{{$category->slug}}" class="btn btn-white">{{ $category->name }}</a>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <!-- // filter -->
                    </div>
                </div>
                <!-- // filters -->
                <!-- discount partners details -->
                @if(count($categories) > 0)
                <div class="col-md-7 col-lg-8 col-xl-9">
                    @foreach($categories as $category)
                    <!-- cat -->
                    <div class="discount-partner__section" id="{{ $category->slug }}">
                        <h3 class="h4" data-aos="fade-up">{{ $category->name }}</h3>
                        <div class="discount__container" data-aos="fade-up" data-aos-delay="100">
                            <!-- discount block -->
                            <div class="discount__block d-none d-lg-block">
                                <div class="row">
                                    <div class="col-12 col-lg-6 col-xl-8 d-flex align-items-center">
                                        <h4 class="h6">{{ $category->name }}</h4>
                                    </div>
                                    <div class="col-6 col-lg-3 col-xl-2 d-flex align-items-center justify-content-lg-center">
                                        <h4 class="h6">{{ __("messages.Price") }}</h4>
                                    </div>
                                    <div class="col-6 col-lg-3 col-xl-2 d-flex align-items-center justify-content-lg-center">
                                        <h4 class="h6">{{ __("messages.Book Now") }}</h4>
                                    </div>
                                </div>
                            </div>
                            <!-- // discount block -->
                            @foreach(\Modules\Discount\Models\Discount::where('card_id', $card->id)->where('category_id',$category->id)->get() as $discount)
                            <!-- discount block -->
                            <div class="discount__block">
                                <div class="row">
                                    <div class="col-12 col-lg-6 col-xl-8 d-flex align-items-center">
                                        <h4 class="h6">{{ $discount->name }}</h4>
                                    </div>
                                    <div class="col-6 col-lg-3 col-xl-2 d-flex align-items-center justify-content-lg-center">
                                        <h4 class="h6 color">{{ $discount->price }} <small>{{ (app()->getLocale() == 'ar') ? 'ريال' : 'SAR'}}</small></h4>
                                    </div>
                                    <div class="col-6 col-lg-3 col-xl-2 d-flex align-items-center justify-content-lg-center">
                                        <a href="{{ route('web.discounts.book', app()->getLocale() == 'en' ? ['id' => $discount->id ,'lang' => 'en'] : ['id' => $discount->id]) }}" class="btn btn-brand-link btn-md-block">
                                            {{ __("messages.Book Now") }}
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <!-- // discount block -->
                            @endforeach
                            <!-- discount branches -->
                            <div class="discount__branches">
                                <div class="row">
                                    @if(count($category->branches) > 0)
                                    <div class="col-xl-4 d-flex align-items-center">
                                        <h4 class="h6">{{ __("messages.Available in these Branches") }}:</h4>
                                    </div>
                                    <div class="col-xl-8 d-flex align-items-center">
                                        <ul class="list-inline">
                                            @foreach($category->branches as $branch)
                                                <li class="list-inline-item">{{$branch->name}}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <!-- // discount branches -->
                        </div>
                    </div>
                    <!-- // cat -->
                    @endforeach
                </div>
                @endif
                <!-- // discount partners details -->
            </div>
        </div>
    </div>
    <!-- // discount partners details -->
@endsection
