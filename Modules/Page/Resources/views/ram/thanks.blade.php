@extends('web.layouts.base')
@section('styles')
    <link rel="stylesheet preload" href="{{latest('/web/assets2/css/thanks'.((app()->getLocale() == 'ar') ? '-rtl' : '').'.min.css')}}" as="style" crossorigin>
@endsection
@section('pageTitle')
{{ __("messages.We have received") }}
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
                {{ __("messages.We have received") }}
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
                <h2 class="title" data-aos="fade-up">
                    {{ __("messages.Thank you") }}, <br>
                    <span class="color">{{ __("messages.We have received") }}</span>
                </h2>
            </div>
            <!-- // title -->
        </div>
    </section>
    <!-- // thanks -->


@endsection
@section('submit.scripts')
    {!! settings()->get('thanks.body.scripts') !!}
@endsection
