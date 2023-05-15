@extends('web.layouts.base')

@section('styles')
    <link rel="stylesheet" href="{{latest('/web/assets2/css/before-and-after'. ((app()->getLocale() == 'ar') ? '-rtl' : '').'.min.css')}}" crossorigin="anonymous">
@endsection
@section('pageTitle')
{{ __('messages.Before and After Cases') }}
@endsection

@section('slug')
@if(app()->getLocale() == 'ar')
<li class="list-inline-item d-none d-xl-inline-block">
    <a href="{{ route(Route::currentRouteName(), array_replace(Route::getCurrentRoute()->parameters(), ['locale' =>'en' ])) }}" class="lang">
        English
    </a>
</li>
@else
<li class="list-inline-item d-none d-xl-inline-block">
    <a href="{{ route(Route::currentRouteName(), array_replace(Route::getCurrentRoute()->parameters(), ['locale' =>'ar' ])) }}" class="lang">
        عربي
    </a>
</li>
@endif
@endsection
@section('lang-mobile')
@if(app()->getLocale() == 'ar')
<a href="{{ route(Route::currentRouteName(), array_replace(Route::getCurrentRoute()->parameters(), ['locale' =>'en' ])) }}" class="d-xl-none lang">English</a>
@else
<a href="{{ route(Route::currentRouteName(), array_replace(Route::getCurrentRoute()->parameters(), ['locale' =>'ar' ])) }}" class="d-xl-none lang">عربي</a>
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
                {{ __("messages.Before and After Cases") }}
            </h1>
            <!-- title -->
        </div>
    </div>
    <!-- // page header -->


    <!-- before and after -->
    <div class="before-and-after d-pad">
        <div class="container">
            <!-- title -->
            <div class="section-title">
                <h2 class="title" data-aos="fade-up">
                    {!! __("messages.Before and After") !!}
                </h2>
                <p data-aos="fade-up" data-aos-delay="100">
                    {{ __("messages.You will live a unique experience during") }}
                </p>
            </div>
            <!-- // title -->
            <div class="row">
                <!-- filters -->
                <div class="col-lg-4 col-xl-3">
                    <div class="filters">
                        <!-- search -->
{{--                        <div class="filters__bg" data-aos="fade-up">--}}
{{--                            <div class="filter__search">--}}
{{--                                <form>--}}
{{--                                    <input type="search" class="form-control" placeholder="Search for a doctor">--}}
{{--                                    <button type="button" class="btn btn-brand-primary btn-icon">--}}
{{--                                        <span class="sr-only">Search</span>--}}
{{--                                        <svg>--}}
{{--                                            <use href="/web/assets/images/icons/icons.svg#search"></use>--}}
{{--                                        </svg>--}}
{{--                                    </button>--}}
{{--                                </form>--}}
{{--                            </div>--}}
{{--                        </div>--}}
                        <!-- // search -->
                        <!-- filter -->
                        <div class="filters__bg" data-aos="fade-up">
                            <div class="filter__btns">
                                <div class="nav flex-column nav-pills">
                                    <a href="{{ route('web.Casings.index', ['locale' => app()->getLocale()]) }}" class="btn btn-white @if(!request()->has('category')) active @endif">{{ __("messages.All Cases") }}</a>
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
                <!-- cases -->
                <div class="col-lg-8 col-xl-9">
                    <!-- cases -->
                    <div class="cases">
                        @foreach($cases as $case)
                        <!-- case -->
                        <div class="case" data-aos="zoom-in">
                            <div class="case__images twentytwenty-container">
                                <picture>
                                    <source srcset="{{ $case->image_before }}" type="image/webp"><img src="{{ $case->image_before }}"
                                                                                                               draggable="false" loading="lazy" alt="before">
                                </picture>
                                <picture>
                                    <source srcset="{{ $case->image_after }}" type="image/webp"><img src="{{ $case->image_after }}"
                                                                                                               draggable="false" loading="lazy" alt="after">
                                </picture>
                            </div>
                            <div class="case__info d-flex justify-content-between align-items-center">
                                <a href="{{ route('web.doctors.details', ['locale' => app()->getLocale(), 'slug' => $case->doctor->slug]) }}" class="case__doctor">
                                    <div class="case__doctor-image">
                                        <picture>
                                            <source srcset="{{ $case->doctor->image }}" type="image/webp"><img src="{{ $case->doctor->image }}"
                                                                                                                 draggable="false" loading="lazy" alt="doctor name">
                                        </picture>
                                    </div>
                                    <h3 class="h6">{{ $case->doctor->name }}</h3>
                                </a>
                                <a href="{{ request()->fullUrlWithQuery(['category' => $case->category->id]) }}" class="case__doctor-spec">
                                    {{ $case->category->name }}
                                </a>
                            </div>
                        </div>
                        <!-- // case -->
                        @endforeach
                    </div>
                    <!-- // article -->
                    <!-- pagination -->
                    {{ $cases->appends(app()->getLocale() == 'en' ? ['lang' => 'en'] : '')->links('web.home.pagination') }}
                    <!-- // pagination -->
                    <!-- // cases -->
                </div>
                <!-- // cases -->
            </div>
        </div>
    </div>
    <!-- // before and after -->


@endsection
