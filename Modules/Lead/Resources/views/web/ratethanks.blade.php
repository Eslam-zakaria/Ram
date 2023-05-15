@extends('web.layouts.base')

@section('styles')
    <link rel="stylesheet preload" href="{{latest('/web/assets2/css/thanks'.((app()->getLocale() == 'ar') ? '-rtl' : '').'.min.css')}}" as="style" crossorigin>
@endsection

@section('pageTitle')
{{ __('messages.We have received review') }}
@endsection

@section('slug')
@if(app()->getLocale() == 'ar')
<li class="list-inline-item d-none d-xl-inline-block">
    <a href="{{ route(Route::currentRouteName(), array_replace(Route::getCurrentRoute()->parameters(), ['lang' =>'en' ])) }}" class="lang">
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
<a href="{{ route(Route::currentRouteName(), array_replace(Route::getCurrentRoute()->parameters(), ['lang' =>'en' ])) }}" class="d-xl-none lang">English</a>
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
                    <img src="{{latest('/web/assets/images/page-header.jpg')}}" draggable="false"
                        alt="page image" data-aos="zoom-out">
                </picture>
            </div>
            <!-- // image -->
            <!-- title -->
            <h1 class="h3" data-aos="fade-up" data-aos-delay="100">
            {{ __('messages.We have received review') }}
            </h1>
            <!-- title -->
        </div>
    </div>
    <!-- // page header -->


    <!-- thanks -->
    <section class="thanks d-pad">
        <div class="container">
            <!-- title -->
            <div class="section-title">
                 {!! settings()->get('thanks.title.rates.page') !!}
                <a href="{{ url(app()->getLocale() != 'ar' ? 'services?lang=en' : 'services') }}" class="btn btn-brand-primary" data-aos="fade-up" data-aos-delay="200">
                {{ __('messages.View all services') }}
                </a>
                <a href="{{ route('web.home.index', app()->getLocale() == 'en' ? ['lang' => 'en'] : '') }}" class="btn btn-brand-primary-5" data-aos="fade-up" data-aos-delay="200">
                {{ __('messages.Home') }}
                </a>
            </div>
            <!-- // title -->
        </div>
    </section>
    <!-- // thanks -->
@endsection
