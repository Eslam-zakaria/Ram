@extends('web.layouts.base')

@section('styles')
    <link rel="stylesheet" href="{{latest('/web/assets2/css/partners'. ((app()->getLocale() == 'ar') ? '-rtl' : ''). '.min.css')}}" crossorigin="anonymous">
@endsection

@section('pageTitle')
{{ __("messages.Partners Discount") }}
@endsection

@section('metaKeys')
    {!! $settings['discounts_cards.seo'][app()->getLocale()] ?? '' !!}
@endsection

@section('slug')
@if(app()->getLocale() == 'ar')
<li class="list-inline-item d-none d-xl-inline-block">
    <a href="{{ route(Route::currentRouteName(), ['lang' =>'en' ]) }}" class="lang">
        English
    </a>
</li>
@else
<li class="list-inline-item d-none d-xl-inline-block">
    <a href="{{ route(Route::currentRouteName()) }}" class="lang">
        عربي
    </a>
</li>
@endif
@endsection
@section('lang-mobile')
@if(app()->getLocale() == 'ar')
<a href="{{ route(Route::currentRouteName(), ['lang' =>'en' ]) }}" class="d-xl-none lang">English</a>
@else
<a href="{{ route(Route::currentRouteName()) }}" class="d-xl-none lang">عربي</a>
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
                {{ __("messages.Partners Discount") }}
            </h1>
            <!-- title -->
        </div>
    </div>
    <!-- // page header -->


    <!-- discount partners -->
    <section class="discount-partners d-pad">
        <div class="container">
            <!-- title -->
            <div class="section-title">
                {!! settings()->get('titlesheader.discounts.page') !!}
            </div>
            <!-- // title -->
            <div class="row">
                <!-- filters -->
                <div class="col-lg-4 col-xl-3">
                    <div class="filters">
                        <!-- search -->
                       <div class="filters__bg" data-aos="fade-up">
                           <div class="filter__search">
                                <form method="GET" action="{{ route('web.discounts.index', app()->getLocale() == 'en' ? ['lang' => 'en'] : '') }}">
                                   <input type="search" name="q" class="form-control" placeholder="@if (request()->has('q')) {{ request()->get('q') }} @else {{ (app()->getLocale() == 'ar') ? 'البحث في الشركاء' : 'Search for a partner'}} @endif">
                                   <button type="submit" class="btn btn-brand-primary btn-icon">
                                       <span class="sr-only">{{ __('messages.search') }}</span>
                                       <svg>
                                           <use href="{{latest('/web/assets/images/icons/icons.svg#search')}}"></use>
                                       </svg>
                                   </button>
                               </form>
                           </div>
                       </div>
                        <!-- // search -->
                        <!-- filter -->
                        <div class="filters__bg" data-aos="fade-up">
                            <div class="filter__btns">
                                <div class="nav flex-column nav-pills">
                                    <a href="{{ route('web.discounts.index', app()->getLocale() == 'en' ? ['lang' => 'en'] : '') }}" class="btn btn-white @if(!request()->has('category')) active @endif">{{ __("messages.All Partners") }}</a>
                                    @foreach($categories as $category)
                                        <a href="{{ request()->fullUrlWithQuery(['category' => $category->id]) }}" class="btn btn-white @if(request()->get('category') == $category->id) active @endif">{{ $category->name }}</a>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <!-- // filter -->
                    </div>
                </div>
                <!-- // filters -->
                <!-- discount partners -->
                <div class="col-lg-8 col-xl-9">
                    <div class="discount-partners__container">
                        @foreach($cards as $card)
                        <!-- partner -->
                        <div class="discount-partner" data-aos="fade-up">
                            <!-- image -->
                            <a href="{{ route('web.discounts.details', app()->getLocale() == 'en' ? ['card' => $card->id ,'lang' => 'en'] : ['card' => $card->id]) }}" class="discount-partner__image">
                                <picture>
                                    <source srcset="{{ $card->image }}" type="image/webp"><img
                                        src="{{ $card->image }}" draggable="false" loading="lazy" alt="alt">
                                </picture>
                            </a>
                            <!-- // image -->
                            <!-- info -->
                            <div class="discount-partner__info">
                                <div class="discount-partner__title">
                                    <h3 class="h6">
                                        <a href="{{ route('web.discounts.details', app()->getLocale() == 'en' ? ['card' => $card->id ,'lang' => 'en'] : ['card' => $card->id]) }}">
                                            {{ $card->name }}
                                        </a>
                                    </h3>
                                </div>
                                <!-- icons -->
                                <ul class="list-inline discount-partner__icons">
                                    <li class="list-inline-item">
                                        <svg class="icon">
                                            <use href="{{latest('/web/assets/images/icons/icons.svg#dental')}}"></use>
                                        </svg>
                                    </li>
                                    <li class="list-inline-item">
                                        <svg class="icon">
                                            <use href="{{latest('/web/assets/images/icons/icons.svg#derma')}}"></use>
                                        </svg>
                                    </li>
                                    <li class="list-inline-item">
                                        <svg class="icon">
                                            <use href="{{latest('/web/assets/images/icons/icons.svg#medical')}}"></use>
                                        </svg>
                                    </li>
                                </ul>
                                <!-- // icons -->
                                <!-- action -->
                                <div class="discount-partner__btn">
                                    <a href="{{ route('web.discounts.details', app()->getLocale() == 'en' ? ['card' => $card->id ,'lang' => 'en'] : ['card' => $card->id]) }}" class="btn btn-brand-white btn-block">
                                        {{ __("messages.View Discounts") }}
                                    </a>
                                </div>
                                <!-- // action -->
                            </div>
                            <!-- // info -->
                        </div>
                        <!-- // partner -->
                        @endforeach
                    </div>
                    <!-- pagination -->
                        {{ $cards->appends(app()->getLocale() == 'en' ? ['lang' => 'en'] : '')->links('web.home.paginationv2') }}
                    <!-- // pagination -->
                </div>
                <!-- // discount partners -->
            </div>
        </div>
    </section>
    <!-- // discount partners -->

@endsection
