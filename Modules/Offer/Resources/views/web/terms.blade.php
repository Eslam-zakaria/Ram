@extends('web.layouts.base')

@section('styles')
    <link rel="stylesheet" href="{{latest('/web/assets2/css/about'. ((app()->getLocale() == 'ar') ? '-rtl' : '').'.min.css')}}" crossorigin="anonymous">
@endsection

@section('pageTitle')
    {{ (app()->getLocale() == 'ar') ? 'الشروط والأحكام العامة للعروض' : 'General terms and conditions of offers'}}
@endsection

@section('metaKeys')
    {!! $settings['terms_and_conditions.seo'][app()->getLocale()] ?? '' !!}
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
            {{ (app()->getLocale() == 'ar') ? 'الشروط والأحكام العامة للعروض' : 'General terms and conditions of offers'}} <br> <span class="color">لمجموعة عيادات رام</span>
            </h1>
            <!-- // title -->
        </div>
    </div>
    <!-- // page header -->
    <!-- doctors -->
    <section class="doctors d-pad">
        <div class="container">

                {!! settings()->get('offers.terms.page') !!}
        </div>
    </section>
    <!-- // doctors -->
@stop
