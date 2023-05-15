@extends('web.layouts.base')

@section('styles')
    <link rel="stylesheet" href="/web/assets2/css/about{{ (app()->getLocale() == 'ar') ? '-rtl' : ''}}.min.css" crossorigin="anonymous">
@endsection

@section('pageTitle', $settings['metatitle.about'][app()->getLocale()] ?? __('messages.About Ram Clinics') )

@section('metaKeys')
    {!! $settings['about.ceo'][app()->getLocale()] ?? '' !!}
@endsection

@section('slug')
    <li class="list-inline-item d-none d-xl-inline-block">
        <a href="{{ url(app()->getLocale() != 'ar' ? 'about-us' : 'about-us?lang=en') }}" class="lang">
            {{ app()->getLocale() != 'ar' ? __('messages.ar') : __('messages.en') }}
        </a>
    </li>
@endsection

@section('lang-mobile')
    <a href="{{ url(app()->getLocale() != 'ar' ? 'about-us' : 'about-us?lang=en') }}" class="d-xl-none lang">
        {{ app()->getLocale() != 'ar' ? __('messages.ar') : __('messages.en') }}
    </a>
@endsection

@section('content')
    <!-- page header -->
    <div class="page-header">
        <div class="container">
            <!-- image -->
            <div class="page-header__image">
                <picture>
                    <source srcset="/web/assets/images/page-header.webp" type="image/webp"><img src="/web/assets/images/page-header.jpg" draggable="false"
                                                                                                alt="page image" data-aos="zoom-out">
                </picture>
            </div>
            <!-- // image -->
            <!-- title -->
            <h1 class="h3" data-aos="fade-up" data-aos-delay="100">
                {{ __("messages.About Ram Clinics") }}
            </h1>
            <!-- // title -->
        </div>
    </div>
    <!-- // page header -->


    <!-- about -->
    <div class="about d-pad">
        <div class="container">
            <div class="about__container d-flex align-items-center">
                <!-- image -->
                <div class="about__image">
                    <picture>
                        <source srcset="/web/assets/images/about.webp" type="image/webp"><img src="/web/assets/images/about.jpg" draggable="false" alt="alt"
                                                                                              data-aos="zoom-out">
                    </picture>
                </div>
                <!-- // image -->
                <!-- text -->
                <div class="about__text">
                    <div class="overline" data-aos="fade-up">
                        {{ __("messages.About Ram Clinics") }}
                    </div>
                    {!! $settings['about.page.first.section'][app()->getLocale()] ?? '' !!}
                </div>
                <!-- // text -->
            </div>
        </div>
    </div>
    <!-- // about -->


    <!-- statistics -->
    <section class="statistics">
        <div class="container">
            <div class="statistics__container">
                <!-- statistic -->
            {!! $settings['about.page.statistics.section'][app()->getLocale()] ?? '' !!}
            <!-- // statistic -->
            </div>
        </div>
    </section>
    <!-- // statistics -->


    <!-- blocks -->
    <div class="about__blocks">
        <div class="container">
            <div class="about__container d-flex">
                <!-- block -->
            {!! $settings['about.page.visions.section'][app()->getLocale()] ?? '' !!}
            <!-- // block -->
            </div>
        </div>
    </div>
    <!-- // blocks -->


    <!-- book now -->
    <section class="book-now">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 d-flex align-items-center">
                    <h2 class="h3" data-aos="fade-up">
                        {{ __('messages.Would you like') }}
                    </h2>
                </div>
                <div class="col-lg-6 d-flex align-items-center justify-content-lg-end">
                    <a href="{{ url('book-an-appointment' . ( app()->getLocale() != 'ar' ? ( '/?lang=' . app()->getLocale() ) : '')) }}/" class="btn btn-brand-white Booking_ads" data-aos="zoom-in">
                        {{ __('messages.Book Now') }}
                        <svg class="btn-icon">
                            <use href="/web/assets/images/icons/icons.svg#book"></use>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </section>
    <!-- // book now -->


    <!-- doctors -->
    <section class="doctors d-pad">
        <div class="container">
            <!-- title -->
            <div class="title-container" data-aos="fade-up">
                <h2 class="title">
                    {!! __("messages.Our Great Doctors") !!}
                </h2>
                <a href="{{ route('web.doctors.index', app()->getLocale() == 'en' ? ['lang' => 'en'] : '')}}" class="btn btn-brand-link">
                    {{ __('messages.all doctors') }}
                    <svg class="btn-icon">
                        <use href="/web/assets/images/icons/icons.svg#btn-arrow"></use>
                    </svg>
                </a>
            </div>
            <!-- // title -->
            <div class="title-container" data-aos="fade-up">
                {!! $settings['about.page.teamwork.section'][app()->getLocale()] ?? '' !!}
            </div>
            <!-- doctors slider -->
            <div class="swiper doctorsSlider" data-aos="fade-up" data-aos-delay="100">
                <div class="swiper-wrapper">
                @foreach($doctors as $doctor)
                    <!-- slide -->
                        <div class="swiper-slide">
                            <div class="doctor">
                                <!-- img -->
                                <div class="doctor__image">
                                    <picture>
                                        <source srcset="{{ $doctor->image }}" type="image/webp"><img src="{{ $doctor->image }}"
                                                                                                     draggable="false" alt="alt">
                                    </picture>
                                </div>
                                <!-- // img -->
                                <!-- info -->
                                <div class="doctor__info">
                                    <h3 class="h5">
                                        {{ $doctor->name }}
                                    </h3>
                                    <span class="doctor__department color d-block">@if(app()->getLocale() == 'ar') رام @else Ram @endif {{ $doctor->service->name }}</span>
                                    <span class="doctor__branch d-block">{{ $doctor->country->name }}</span>
                                </div>
                                <!-- // info -->
                                <!-- actions -->
                                <div class="doctor__actions d-flex justify-content-center">
                                    <a href="{{ url('book-an-appointment'. '/?doctor='. $doctor->id . ( app()->getLocale() != 'ar' ? ( '&lang=' . app()->getLocale()) : '')) }}" class="btn btn-brand-primary Booking_ads">
                                        {{ __("messages.Book Now") }}
                                        <svg class="btn-icon">
                                            <use href="/web/assets/images/icons/icons.svg#book"></use>
                                        </svg>
                                    </a>
                                    <a href="{{ route('web.doctors.details', app()->getLocale() == 'en' ? ['slug' => $doctor->slug ,'lang' => 'en'] : ['slug' => $doctor->slug]) }}" class="btn btn-white">{{ __('messages.More') }}</a>
                                </div>
                                <!-- // actions -->
                            </div>
                        </div>
                        <!-- // slide -->
                    @endforeach
                </div>
                <div class="slider-controls">
                    <div class="swiper-button-next doctor-next"></div>
                    <div class="swiper-button-prev doctor-prev"></div>
                </div>
            </div>
            <!-- // doctors slider -->
        </div>
    </section>
    <!-- // doctors -->

    <!-- more -->
    <div class="about__more">
        <div class="container">
            <h2 class="title" data-aos-delay="fade-up">
                {!! __("messages.You are in") !!}
            </h2>
            <div class="about__container d-flex">
                <!-- more -->
                <div class="about__more-block d-flex">
                    <div class="about__more-block-image">
                        <picture>
                            <source srcset="/web/assets/images/about-more-1.webp" type="image/webp"><img src="/web/assets/images/about-more-1.jpg"
                                                                                                         draggable="false" loading="lazy" alt="alt" data-aos="zoom-out">
                        </picture>
                    </div>
                    <div class="about__more-block-text" data-aos="fade-up">
                        {!! $settings['about.page.savehand1.section'][app()->getLocale()] ?? '' !!}
                    </div>
                </div>
                <!-- // more -->
                <!-- more -->
                <div class="about__more-block d-flex">
                    <div class="about__more-block-image">
                        <picture>
                            <source srcset="/web/assets/images/about-more-2.webp" type="image/webp"><img src="/web/assets/images/about-more-2.jpg"
                                                                                                         draggable="false" loading="lazy" alt="alt" data-aos="zoom-out">
                        </picture>
                    </div>
                    <div class="about__more-block-text" data-aos="fade-up">
                        {!! $settings['about.page.savehand2.section'][app()->getLocale()] ?? '' !!}
                    </div>
                </div>
                <!-- // more -->
            </div>
        </div>
    </div>
    <!-- more -->
@stop
