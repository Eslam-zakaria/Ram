@extends('web.layouts.base')

@section('pageTitle', $settings['metatitle.home'][app()->getLocale()] ?? __('messages.Website title'))

@section('styles')
    <link rel="preload" href="{{latest('/web/assets/css/home'. ((app()->getLocale() == 'ar') ? '-rtl' : '').'.min.css')}}" crossorigin="anonymous"
    as="style" onload="this.onload=null;this.rel='stylesheet'">
@endsection

@section('metaKeys')
    {!! $settings['home.ceo'][app()->getLocale()] ?? '' !!}
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
    <!-- slider -->
    <div class="slider">
        <div class="swiper mainSlider">
            <div class="swiper-wrapper">
                <!-- slide -->
                @if(!empty($sliders))
                    @foreach($sliders as $slid)
                        <div class="swiper-slide">
                            <div class="slider__slide">
                                <!-- img -->
                                <div class="slider__image">
                                    <picture>
                                        <source class="swiper-lazy" srcset="{{ $slid->image }}" type="image/webp">
                                        <source class="swiper-lazy" srcset="{{ $slid->image }}" type="image/jpeg">
                                        <img  class="swiper-lazy lazyload" src="{{ $slid->image }}" draggable="false" alt="alt">
                                    </picture>
                                    <div class="swiper-lazy-preloader"></div>
                                </div>
                                <!-- // img -->
                                <!-- text -->
                                <div class="slider__text">
                                    <div class="container">
                                        {!! $slid->description !!}
                                        <div class="slider__actions" data-aos="fade-up" data-aos-delay="500">
                                            <a href="{{ url('book-an-appointment' . ( app()->getLocale() != 'ar' ? ( '/?lang=' . app()->getLocale() ) : '')) }}/" class="btn btn-brand-primary Booking_ads">
                                                {{ __('messages.Book Now') }}
                                                <svg class="btn-icon">
                                                    <use href="{{latest('/web/assets/images/icons/icons.svg#book')}}"></use>
                                                </svg>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <!-- // text -->
                            </div>
                        </div>
                @endforeach
            @endif
            <!-- // slide -->
            </div>
        </div>
    </div>
    <!-- // slider -->

    <!-- slider overlay -->
    <div class="slider-overlay">
        <div class="container">
            <div class="slider-overlay__container">
                <div class="row">
                    <!-- nearest branch -->
                    <div class="col-lg-4">
                        <div class="overlay-bg nearest-branch" data-toggle="modal" data-target="#nearestBranch" data-aos="zoom-out-up"
                            data-aos-delay="100">
                            <div class=" overlay-bg__icon">
                                <svg class="icon">
                                    <use href="{{latest('assets/images/icons/icons.svg#location')}}"></use>
                                </svg>
                            </div>
                            {!! $settings['briefbranches.home.page'][app()->getLocale()] ?? '' !!}
                        </div>
                    </div>
                    <!-- // nearest branch -->
                </div>
                <!-- // opening times -->
                <div class="overlay-bg__times">
                    <!-- opening times -->
                    <div class="overlay-bg opening" data-aos="zoom-out-up">
                        <div class="overlay-bg__icon">
                            <svg class="icon">
                                <use href="{{latest('/web/assets/images/icons/icons.svg#dental')}}"></use>
                            </svg>
                        </div>
                        {!! $settings['timework.home.page'][app()->getLocale()] ?? '' !!}
                    </div>
                    <!-- // opening times -->
                    <!-- opening times -->
                    <div class="overlay-bg opening" data-aos="zoom-out-up">
                        <div class="overlay-bg__icon">
                            <svg class="icon">
                                <use href="{{latest('/web/assets/images/icons/icons.svg#derma')}}"></use>
                            </svg>
                        </div>
                        {!! $settings['timework.derma.home.page'][app()->getLocale()] ?? '' !!}
                    </div>
                    <!-- // opening times -->
                    <!-- opening times -->
                    <div class="overlay-bg opening" data-aos="zoom-out-up">
                        <div class="overlay-bg__icon">
                            <svg class="icon">
                                <use href="{{latest('/web/assets/images/icons/icons.svg#medical')}}"></use>
                            </svg>
                        </div>
                        {!! $settings['timework.medical.home.page'][app()->getLocale()] ?? '' !!}
                    </div>
                    <!-- // opening times -->
                </div>
            </div>
        </div>
    </div>
    <!-- // slider overlay -->
    <!-- nearest branch model -->
    <div class="modal fade" id="nearestBranch" tabindex="-1" aria-labelledby="nearestBranchLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <button type="button" class="close ml-auto" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <div class="modal-header">
                    <h4 class="modal-title" id="nearestBranchLabel">@lang('messages.branch nearest')</h4>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <label>{{ __('messages.Choose service provided') }}:</label>
                            <nav class="services-nav">
                                @if(!empty($services))
                                    @foreach($services as $serv)
                                        <span onclick="updateServiceId({{ $serv->id }})" id="services-{{ $serv->id }}" class="btn btn-brand-primary-5 {{ $loop->first ? 'active' : '' }}">
                                            <svg class="icon">
                                                <use href="{{latest('/web/assets/images/icons/icons.svg#'.$serv->icon) }}"></use>
                                            </svg>
                                            {{ $serv->name }}
                                        </span>
                                    @endforeach
                                @endif
                            </nav>
                        </div>
                        <input type="hidden" id="ServiceId" name="service" value="1">
                        <div class="form-group">
                            <label for="nearestBranchSelect">{{ __('messages.branch nearest') }}:</label>
                            <select class="custom-select" id="nearestBranchSelect" name="branche_id">
                                <option value="">@lang('messages.Do you want choose')</option>
                                @if(!empty($countries))
                                    @foreach($countries as $country)
                                        <optgroup label="{{ $country->name }}">
                                            @foreach($country->branche as $branch)
                                                <option value="{{ $branch->id }}">{{ $branch->name }}</option>
                                            @endforeach
                                        </optgroup>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        <div class="form-group text-center">
                            <a onclick="return sendBook();" class="btn btn-brand-primary">
                                {{ __('messages.Book Now') }}
                                <svg class="btn-icon">
                                    <use href="{{ latest('/web/assets/images/icons/icons.svg#book') }}"></use>
                                </svg>
                            </a>
                            <a href="{{ route('web.branches.index', app()->getLocale() == 'en' ? ['lang' => 'en'] : '') }}" class="btn btn-white">
                                @lang('messages.View all branches')
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- // nearest branch model -->

    <!-- statistics -->
    <section class="statistics">
        <div class="container">
            <div class="statistics__container">
                <!-- statistic -->
                <div class="statistic" data-aos="fade-up">
                    <div class="statistic__icon">
                        <svg class="icon">
                            <use href="{{latest('/web/assets/images/icons/icons.svg#country')}}"></use>
                        </svg>
                    </div>
                    {!! $settings['statistic.country.home.page'][app()->getLocale()] ?? '' !!}
                </div>
                <!-- // statistic -->
                <!-- statistic -->
                <!-- <div class="statistic" data-aos="fade-up" data-aos-delay="100">
                    <div class="statistic__icon">
                        <svg class="icon">
                            <use href="/web/assets/images/icons/icons.svg#branch"></use>
                        </svg>
                    </div>
                    {!! $settings['statistic.branch.home.page'][app()->getLocale()] ?? '' !!}
                </div> -->
                <!-- // statistic -->
                <!-- statistic -->
                <div class="statistic" data-aos="fade-up" data-aos-delay="200">
                    <div class="statistic__icon">
                        <svg class="icon">
                            <use href="{{latest('/web/assets/images/icons/icons.svg#doctor')}}"></use>
                        </svg>
                    </div>
                    {!! $settings['statistic.doctor.home.page'][app()->getLocale()] ?? '' !!}
                </div>
                <!-- // statistic -->
                <!-- statistic -->
                <div class="statistic" data-aos="fade-up" data-aos-delay="300">
                    <div class="statistic__icon">
                        <svg class="icon">
                            <use href="{{latest('/web/assets/images/icons/icons.svg#client')}}"></use>
                        </svg>
                    </div>
                    {!! $settings['statistic.client.home.page'][app()->getLocale()] ?? '' !!}
                </div>
                <!-- // statistic -->
            </div>
        </div>
    </section>
    <!-- // statistics -->

    <!-- about -->
    <section class="about d-pad">
        <div class="container">
            <div class="row">
                <!-- text -->
                <div class="col-lg-6 d-flex align-items-center">
                    <div class="about__text">
                        {!! $settings['about.home.page'][app()->getLocale()] ?? '' !!}
                        <div class="about__text-actions" data-aos="fade-up" data-aos-delay="400">
                            <a href="{{ url('about-us' . ( app()->getLocale() != 'ar' ? ( '/?lang=' . app()->getLocale() ) : '')) }}" class="btn btn-brand-link">
                                {{ (app()->getLocale() == 'ar') ? 'المزيد عن عيادات رام' : 'More about Ram Clinics'}}
                                <svg class="btn-icon">
                                    <use href="{{latest('/web/assets/images/icons/icons.svg#btn-arrow')}}"></use>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
                <!-- // text -->
                <!-- image -->
                <div class="col-lg-6">
                    <div class="about__image d-flex">
                        <div class="about__image-container" data-aos="zoom-out">
                            <picture>
                                <source class="lazyload" src="{{latest('/web/assets/images/placeholder.svg')}}" data-srcset="{{latest('/web/assets/images/about-1.webp')}}" type="image/webp">
                                <img class="lazyload" src="{{latest('/web/assets/images/placeholder.svg')}}" data-src="{{latest('/web/assets/images/about-1.jpg')}}" draggable="false" loading="lazy" alt="ram clinics">
                            </picture>
                        </div>
                        <div class="about__image-container" data-aos="zoom-out">
                            <picture>
                                <source class="lazyload" src="{{latest('/web/assets/images/placeholder.svg')}}" data-srcset="{{latest('/web/assets/images/about-2.webp')}}" type="image/webp">
                                <img class="lazyload" src="{{latest('/web/assets/images/placeholder.svg')}}" data-src="{{latest('/web/assets/images/about-2.jpg')}}" draggable="false"
                                                                                                        loading="lazy" alt="ram clinics">
                            </picture>
                        </div>
                    </div>
                </div>
                <!-- // image -->
            </div>
        </div>
    </section>
    <!-- // about -->

    <!-- cards -->
    <div class="ram-cards">
        <div class="container">
            <div class="row">
                <!-- card -->
                <div class="col-lg-6 d-none">
                    <a href="{{ route('web.leads.freeservices', app()->getLocale() == 'en' ? ['lang' => 'en'] : '') }}" class="ram__card d-block">
                        <!-- image -->
                        <div class="ram__card-image" data-aos="zoom-out">
                            <picture>
                                <source class="lazyload" src="{{latest('/web/assets/images/placeholder.svg')}}" data-srcset="{{latest('/web/assets/images/free-services.webp')}}" type="image/webp">
                                <img class="lazyload" src="{{latest('/web/assets/images/placeholder.svg')}}" data-src="{{latest('/web/assets/images/free-services.jpg')}}"
                                                                                                              draggable="false" loading="lazy" alt="free services">
                            </picture>
                        </div>
                        <!-- // image -->
                        <div class="ram__card-text">
                            {!! $settings['free-services.section.home'][app()->getLocale()] ?? '' !!}
                        </div>
                    </a>
                </div>
                <!-- // card -->
                <div class="col-lg-2"></div>
                <!-- card -->
                <div class="col-lg-8">
                    <a href="{{ route('web.leads.rate', app()->getLocale() == 'en' ? ['lang' => 'en'] : '') }}" class="ram__card d-block">
                        <!-- image -->
                        <div class="ram__card-image" data-aos="zoom-out">
                            <picture>
                                <source class="lazyload" src="{{latest('/web/assets/images/placeholder.svg')}}" data-srcset="{{latest('/web/assets/images/rate.webp')}}" type="image/webp">
                                <img class="lazyload" src="{{latest('/web/assets/images/placeholder.svg')}}" data-src="{{latest('/web/assets/images/rate.jpg')}}" draggable="false"
                                                                                                     loading="lazy" alt="rate">
                            </picture>
                        </div>
                        <!-- // image -->
                        <div class="ram__card-text">{!! $settings['rate.section.home'][app()->getLocale()] ?? '' !!}</div>
                    </a>
                </div>
                <!-- // card -->
            </div>
        </div>
    </div>
    <!-- // cards -->

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
                            <use href="{{latest('/web/assets/images/icons/icons.svg#book')}}"></use>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </section>
    <!-- // book now -->

    <!-- services -->
    <section class="services d-pad">
        <div class="container">
            <!-- title -->
            <div class="section-title">
                {!! $settings['services.section.home'][app()->getLocale()] ?? '' !!}
            </div>
            <!-- // title -->
            <!-- services -->
            <div class="services__container" data-aos="fade-up" data-aos-delay="300">
            @foreach($services as $serv)
                <!-- services -->
                    <a href="{{ url($serv->slug) . ( app()->getLocale() != 'ar' ? '?lang=en' : '' ) }}" class="service d-block">
                        <div class="service__image" data-aos="zoom-out">
                            <picture>
                                <source class="lazyload" src="{{latest('/web/assets/images/placeholder.svg')}}" data-srcset="{{ $serv->image }}" type="image/webp" />
                                <img class="lazyload" src="{{latest('/web/assets/images/placeholder.svg')}}" data-src="{{ $serv->image }}" draggable="false" loading="lazy" alt="{{ $serv->alt_image ? $serv->alt_image : '' }}" />
                            </picture>
                        </div>
                        <div class="service__title">
                            <h3 class="h5">
                                <span class="color"> @if(app()->getLocale() == 'ar') خدمات @else Services @endif </span>
                                {{ $serv->name }}
                            </h3>
                        </div>
                    </a>
                    <!-- // services -->
                @endforeach
            </div>
        </div>
    </section>
    <!-- // services -->

    <!-- installments -->
    <section class="installments">
        <div class="container">
            <div class="installments__container">
                <!-- text -->
                <div class="installments__text">
                    <h2 class="h3" data-aos="fade-up">
                        {!! $settings['installments.section.home'][app()->getLocale()] ?? '' !!}
                    </h2>
                    <div class="installments__partners" data-aos="fade-up" data-aos-delay="100">
                        <div class="installments__partner">
                            <picture>
                                <source class="lazyload" src="{{latest('/web/assets/images/placeholder.svg')}}" data-srcset="{{latest('/web/assets/images/tasheel.webp')}}" type="image/webp" />
                                <img class="lazyload" src="{{latest('/web/assets/images/placeholder.svg')}}" data-src="{{latest('/web/assets/images/tasheel.jpg')}}" draggable="false" loading="lazy" alt="tasheel" width="165" height="64" />
                            </picture>
                        </div>
                        <div class="installments__partner">
                            <picture>
                                <source class="lazyload" src="{{latest('/web/assets/images/placeholder.svg')}}" data-srcset="{{latest('/web/assets/images/Tabby.svg')}}" type="image/svg" />
                                <img class="lazyload" src="{{latest('/web/assets/images/placeholder.svg')}}" data-src="{{latest('/web/assets/images/Tabby.svg')}}" draggable="false" loading="lazy" alt="Tabby"  width="165" height="64" />
                            </picture>
                        </div>
                        <div class="installments__partner">
                            <picture>
                                <source class="lazyload" src="{{latest('/web/assets/images/placeholder.svg')}}" data-srcset="{{latest('/web/assets/images/tamara.svg')}}" type="image/svg" />
                                <img class="lazyload" src="{{latest('/web/assets/images/placeholder.svg')}}" data-src="{{latest('/web/assets/images/tamara.svg')}}" draggable="false" loading="lazy" alt="tamara"  width="165" height="64" />
                            </picture>
                        </div>
                    </div>
                    <!-- installments action -->
                    <div class="installments__actions" data-aos="fade-up" data-aos-delay="200">
                        <a href="{{ route('web.leads.index', app()->getLocale() == 'en' ? ['lang' => 'en'] : '') }}" class="btn btn-brand-primary">
                            {{ __('messages.Installment') }}
                        </a>
                    </div>
                    <!-- // installments action -->
                </div>
                <!-- // text -->
                <!-- image -->
                <div class="installments__image" data-aos="zoom-in">
                    <picture>
                        <source class="lazyload" src="{{latest('/web/assets/images/placeholder.svg')}}" data-srcset="{{latest('/web/assets/images/install.webp')}}" type="image/webp" />
                        <img class="lazyload" src="{{latest('/web/assets/images/placeholder.svg')}}" data-src="{{latest('/web/assets/images/install.png')}}" draggable="false" loading="lazy" alt="install now" />
                    </picture>
                </div>
                <!-- // image -->
            </div>
        </div>
    </section>
    <!-- // installments -->

    <!-- doctors -->
    <section class="doctors d-pad">
        <div class="container">
            <!-- title -->
            <div class="title-container" data-aos="fade-up">
                <h2 class="title">
                    {{ (app()->getLocale() == 'ar') ? 'أطباء' : 'Doctors'}} <span class="color">{{ (app()->getLocale() == 'ar') ? 'عيادات رام' : 'Ram Clinics'}}</span>
                </h2>
                <a href="{{ route('web.doctors.index', app()->getLocale() == 'en' ? ['lang' => 'en'] : '') }}" class="btn btn-brand-link">
                    {{ __('messages.View all doctors') }}
                    <svg class="btn-icon">
                        <use href="{{latest('/web/assets/images/icons/icons.svg#btn-arrow')}}"></use>
                    </svg>
                </a>
            </div>
            <!-- // title -->
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
                                        <source class="lazyload" src="{{latest('/web/assets/images/placeholder.svg')}}" data-srcset="{{ $doctor->image }}" type="image/webp" />
                                        <img class="lazyload" src="{{latest('/web/assets/images/placeholder.svg')}}" data-src="{{ $doctor->image }}" draggable="false" alt="{{ $doctor->alt_image ? $doctor->alt_image : '' }}" />
                                    </picture>
                                </div>
                                <!-- // img -->
                                <!-- info -->
                                <div class="doctor__info">
                                    <h3 class="h5">{{ $doctor->name }}</h3>
                                    <span class="doctor__department color d-block">@if(app()->getLocale() == 'ar') رام @else Ram @endif {{ $doctor->service->name }}</span>
                                    <span class="doctor__branch d-block">{{ implode(' ، ' , $doctor->branches->pluck('name')->toArray()) }}</span>
                                </div>
                                <!-- // info -->
                                <!-- actions -->
                                <div class="doctor__actions d-flex justify-content-center">
                                    <a href="{{ url('book-an-appointment'. '/?doctor='. $doctor->id . ( app()->getLocale() != 'ar' ? ( '&lang=' . app()->getLocale()) : '')) }}" class="btn btn-brand-primary Booking_ads">
                                        {{ __('messages.Book Now') }}
                                        <svg class="btn-icon">
                                            <use href="{{latest('/web/assets/images/icons/icons.svg#book')}}"></use>
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

    <!-- reviews -->
    <section class="reviews d-pad">
        <div class="container">
            <!-- title -->
            <h2 class="title" data-aos="fade-up">
                {{ (app()->getLocale() == 'ar') ? 'آراء' : 'Reviews'}} <span class="color">{{ (app()->getLocale() == 'ar') ? 'عملاء رام' : 'Ram Customer'}}</span>
            </h2>
            <!-- // title -->
            <div class="row">
                <!-- testimonial -->
                <div class="col-lg-6 d-flex align-items-stretch">
                    <div class="swiper reviewsSlider" data-aos="fade-up" data-aos-delay="100">
                        <div class="swiper-wrapper">
                        @foreach($testimonials as $testimonial)
                            <!-- slide -->
                                <div class="swiper-slide">
                                    <div class="testimonial d-flex align-items-center justify-content-center flex-column text-center">
                                        <svg class="icon">
                                            <use href="{{latest('/web/assets/images/icons/icons.svg#quote')}}"></use>
                                        </svg>
                                        <p>
                                            {{ $testimonial->description }}
                                        </p>
                                        <h6 class="color">
                                            {{ $testimonial->name }}
                                        </h6>
                                        <ul class="list-inline rate">
                                            <li class="list-inline-item">
                                                <svg class="icon">
                                                    <use href="{{latest('/web/assets/images/icons/icons.svg#star')}}"></use>
                                                </svg>
                                            </li>
                                            <li class="list-inline-item">
                                                <svg class="icon">
                                                    <use href="{{latest('/web/assets/images/icons/icons.svg#star')}}"></use>
                                                </svg>
                                            </li>
                                            <li class="list-inline-item">
                                                <svg class="icon">
                                                    <use href="{{latest('/web/assets/images/icons/icons.svg#star')}}"></use>
                                                </svg>
                                            </li>
                                            <li class="list-inline-item">
                                                <svg class="icon">
                                                    <use href="{{latest('/web/assets/images/icons/icons.svg#star')}}"></use>
                                                </svg>
                                            </li>
                                            <li class="list-inline-item">
                                                <svg class="icon">
                                                    <use href="{{latest('/web/assets/images/icons/icons.svg#star')}}"></use>
                                                </svg>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <!-- // slide -->
                            @endforeach
                        </div>
                        <div class="slider-controls">
                            <div class="swiper-button-next reviews-next"></div>
                            <div class="swiper-button-prev reviews-prev"></div>
                        </div>
                    </div>
                </div>
                <!-- // testimonial -->
                <!-- video -->
                <div class="col-lg-6 d-flex align-items-stretch">
                    <div class="video" data-toggle="modal" data-target="#reviewVideo">
                        <div class="video__thumb" data-aos="fade-up" data-aos-delay="100">
                            <picture>
                                <source class="lazyload" src="{{latest('/web/assets/images/placeholder.svg')}}" data-srcset="{{latest('/web/assets/images/video.webp')}}" type="image/webp"><img class="lazyload" src="{{latest('/web/assets/images/placeholder.svg')}}" data-src="{{latest('/web/assets/images/video.jpg')}}" draggable="false"
                                                                                                      loading="lazy" alt="video name">
                            </picture>
                        </div>
                        <div class="video__btn-container">
                            <div class="video__btn">
                                <svg class="btn-icon">
                                    <use href="{{latest('/web/assets/images/icons/icons.svg#play')}}"></use>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- // video -->
            </div>
        </div>
    </section>
    <!-- // reviews -->

    <!-- review video modal -->
    <div class="modal fade" id="reviewVideo" tabindex="-1" aria-labelledby="reviewVideoLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <button type="button" class="close ml-auto" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <div class="modal-body" id="reviewVideoLabel">
                    <video class="lazyload" src="#" data-src="{{ $settings['video.home.page'][app()->getLocale()] ?? '' }}" preload="metadata" controls></video>
                    <!-- <iframe width="100%" height="500" src="https://www.youtube.com/embed/rTKK9Zx_pqA?controls=0"
                            title="YouTube video player" frameborder="0"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe> -->
                </div>
            </div>
        </div>
    </div>
    <!-- // review video modal -->

    <!-- blog -->
    @if(app()->getLocale() != 'en')
    <section class="blog d-pad">
        <div class="container">
            <!-- title -->
            <div class="title-container" data-aos="fade-up">
                <h2 class="title">
                    {{ (app()->getLocale() == 'ar') ? 'أحدث' : 'Latest'}} <span class="color">{{ (app()->getLocale() == 'ar') ? 'المقالات' : 'Articles'}}</span>
                </h2>
                <a href="{{ url('blogs' . ( app()->getLocale() != 'ar' ? ( '/?lang=' . app()->getLocale() ) : '')) }}" class="btn btn-brand-link">
                    {{ (app()->getLocale() == 'ar') ? 'عرض جميع المقالات' : 'View All Articles'}}
                    <svg class="btn-icon">
                        <use href="{{latest('/web/assets/images/icons/icons.svg#btn-arrow')}}"></use>
                    </svg>
                </a>
            </div>
            <!-- // title -->
            <div class="row">
            @foreach ($articles as $article)
                <!-- article -->
                    <div class="col-lg-6">
                        <div class="blog__article" data-aos="fade-up" data-aos-delay="100">
                            <a href="{{ $article->blogDetailsLink }}" class="d-block blog__article-photo">
                                <picture>
                                    <source srcset="{{ $article->image }}" type="image/webp" />
                                    <img src="{{ $article->image }}" draggable="false" loading="lazy" alt="{{ $article->alt_image ? $article->alt_image : '' }}" />
                                </picture>
                            </a>
                            <div class="blog__article-info">
                                <a href="{{ url($article->category->slug ?? '') . ( app()->getLocale() != 'ar' ? '?lang=en' : '' ) }}" class="overline">
                                    {{ $article->category->name }}
                                </a>
                                <a href="{{ $article->blogDetailsLink }}">
                                    <h3 class="h5">{{ $article->name }}</h3>
                                    <p>
                                        <?php
                                        $brief = strip_tags($article->content);
                                        echo substr($brief, 0, 300) . " ...";
                                        ?>
                                    </p>
                                    <span class="date small">{{ \Carbon\Carbon::parse($article->created_at)->diffForHumans() }}</span>
                                </a>
                            </div>
                        </div>
                    </div>
                    <!-- // article -->
                @endforeach
            </div>
        </div>
    </section>
    @endif
    <!-- // blog -->
@endsection

@section('submit.scripts')
    <script type="text/javascript">

        $(document).ready(function () {
            service_id = $("#ServiceId").val();
            $("#services-"+ service_id +"").addClass("active");
            $("#ServiceId").val(service_id);

            updateServiceId(service_id);

        })

        function updateServiceId(btnId) {

            $(".services-nav span").removeClass("active");
            $("#services-"+ btnId +"").addClass("active");
            $("#ServiceId").val(btnId);
            service_id = $("#ServiceId").val();

            var select = $("#nearestBranchSelect");
            select.empty();
            var content = '<option value="">{{ __('messages.Do you want choose') }}</option>';
            select.append(content);

            if (service_id) {
                $.ajax({
                    type: 'GET',
                    url: route('api.branches.services', {
                        'lang': '{{ app()->getLocale() }}',
                        'service': service_id
                    }),
                    processData: false,
                    contentType: false,
                    success: function (data) {
                        var select = $("#nearestBranchSelect");
                        select.empty();
                        var content = '<option value="">{{ __('messages.Do you want choose') }}</option>';
                        select.append(content);
                        $.each(data.countries, function (index, country) {
                            if(data.branches.length > 0){
                                select.append('<optgroup label="' + country.name + '">');
                            }
                            $.each(data.branches, function (index, branche) {
                                if(country.id == branche.country_id) {
                                    var content = '<option value="' + branche.id + '">' + branche.name + '</option>';
                                    select.append(content);
                                }
                            });
                            if(data.branches.length > 0){
                                select.append('</optgroup>');
                            }
                        });

                    },
                    error: function (data) {
                    }
                });

            }
        }

        function sendBook() {

            service_id = $("#ServiceId").val();
            brancheId  = $("#nearestBranchSelect option:selected").val();
            @if(app()->getLocale() == 'en')
            window.location.href = "/book-an-appointment" + '?service=' + service_id  + '&branche=' + brancheId + '&lang=' + 'en' ;
            @else
            window.location.href = "/book-an-appointment" + '?service=' + service_id  + '&branche=' + brancheId ;
            @endif

        }
    </script>
@endsection
