@extends('web.layouts.base')

@section('styles')
    <link rel="stylesheet preload" href="{{latest('/web/assets2/css/doctors'. ((app()->getLocale() == 'ar') ? '-rtl' : '').'.min.css')}}" as="style" crossorigin>
@endsection

@section('pageTitle')
{{ $doctor->meta_title ? $doctor->meta_title : $doctor->name }}
@endsection

@section('metaKeys')
   <meta property="og:title" content="{{ $doctor->name ?? '' }}" />
   <meta property="og:description" content="{{ $doctor->meta_description ?? '' }}" />
   <meta property="og:type" content="website" />
   <meta property="og:url" content="{{ route('web.doctors.details', app()->getLocale() == 'en' ? ['slug' => $doctor->slug ,'lang' => 'en'] : ['slug' => $doctor->slug ]) }}" />
   <meta property="og:image" content="{{ $doctor->image }}" />

    <!-- Meta description for twitter. -->
    <meta name="twitter:card" content="{{ $doctor->image ?? '/web/assets/images/logo.svg' }}">
    <meta name="twitter:site" content="{{ url('/') }}">
    <meta name="twitter:title" content="{{ $doctor->name ?? '' }}"/>
    <meta name="twitter:description" content="{{ $doctor->meta_description ?? '' }}" />
    <meta name="twitter:image" content="{{ $doctor->image ?? '/web/assets/images/logo.svg' }}" />

    <meta name="title" content="{{ $doctor->meta_title ?? '' }}" />
    <meta name="description" content="{{  $doctor->meta_description ?? '' }}" />
    <meta name="keywords" content="{{  $doctor->meta_keywords ?? ''}}" />
    <link rel="canonical" href="{{ $doctor->canonical_url ?? '' }}" />

@endsection

@section('slug')
@if(app()->getLocale() == 'ar')
<li class="list-inline-item d-none d-xl-inline-block">
    <a href="{{ route(Route::currentRouteName(), array_replace(Route::getCurrentRoute()->parameters(), ['slug' => $doctorSlug->slug ,'lang' =>'en'])) }}" class="lang">
        English
    </a>
</li>
@else
<li class="list-inline-item d-none d-xl-inline-block">
    <a href="{{ route(Route::currentRouteName(), array_replace(Route::getCurrentRoute()->parameters(), ['slug' => $doctorSlug->slug])) }}" class="lang">
        عربي
    </a>
</li>
@endif
@endsection

@section('lang-mobile')
@if(app()->getLocale() == 'ar')
<a href="{{ route(Route::currentRouteName(), array_replace(Route::getCurrentRoute()->parameters(), ['slug' => $doctorSlug->slug ,'lang' =>'en'])) }}" class="d-xl-none lang">English</a>
@else
<a href="{{ route(Route::currentRouteName(), array_replace(Route::getCurrentRoute()->parameters(), ['slug' => $doctorSlug->slug])) }}" class="d-xl-none lang">عربي</a>
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
            <h1 class="h3" data-aos="fade-up" data-aos-delay="100">{{ $doctor->name ?? '' }}</h1>
            <!-- title -->
        </div>
    </div>
    <!-- // page header -->


    <!-- doctor profile -->
    <section class="doctors-profile d-pad">
        <div class="container">
            <div class="row">
                <!-- filters -->
                <div class="col-lg-4">
                    <div class="filters">
                        <!-- doctor image -->
                        <div class="doctor__image">
                            <picture>
                                <source srcset="{{ $doctor->image ?? '' }}" type="image/webp">
                                <img src="{{ $doctor->image ?? '' }}" draggable="false" data-aos="zoom-out" alt="{{ $doctor->alt_image ?  $doctor->alt_image : ''}}">
                            </picture>
                        </div>
                        <!-- // dr image -->
                        <!-- filter -->
                        <div class="filters__bg" data-aos="fade-up">
                            <div class="filter__btns">
                                <div class="nav flex-column nav-pills">
                                    <a href="#profileAbout" class="btn btn-white">{{ __('messages.About the Doctor') }}</a>
                                    <a href="#profileJourney" class="btn btn-white">{{ __('messages.professional journey') }}</a>
                                    <a href="#profileServices" class="btn btn-white">{{ __('messages.Services') }}</a>
                                    <a href="#profileCases" class="btn btn-white">{{ __('messages.Cases before and after') }}</a>
                                    <a href="#profileVideos" class="btn btn-white">{{ __('messages.Videos') }}</a>
                                </div>
                            </div>
                        </div>
                        <!-- // filter -->
                    </div>
                </div>
                <!-- // filters -->
                <!-- profile -->
                <div class="col-lg-8">
                    <!-- title -->
                    <div class="profile__container">
                        <div class="title-container align-items-start" data-aos="fade-up">
                            <h2 class="h4 title">
                                {{ $doctor->name ? $doctor->name : '' }}
                                <span class="d-block color h6">{{ implode(' - ' , $doctor->specificities->pluck('name')->toArray()) }}</span>
                            </h2>
                            <a href="{{ url('book-an-appointment'. '/?doctor='. $doctor->id . '&service='. $doctor->service->id . ( app()->getLocale() != 'ar' ? ( '&lang=' . app()->getLocale()) : '')) }}" class="btn btn-brand-primary Booking_ads">
                            {{ __('messages.Book now with') }} {{ $doctor->name ? $doctor->name : '' }}
                            </a>
                        </div>
                    </div>
                    <!-- // title -->

                    <!-- about -->
                    <div class="profile__container" id="profileAbout">
                        <h3 class="h5 title" data-aos="fade-up">
                        {{ __('messages.About the Doctor') }}
                        </h3>
                        <div class="section-bg" data-aos="fade-up" data-aos-delay="100">
                            <h4 class="h6">{{ $doctor->name ? $doctor->name : '' }}</h4>
                            <p>
                            {!! $doctor->bio ? $doctor->bio : '' !!}
                            </p>
                            <div class="row">
                                <div class="col-md-4">
                                    <h4 class="h6">{{ __('messages.Years of Experience') }}:</h4>
                                    <span class="h3 color">{{ $doctor->years_of_experience ? $doctor->years_of_experience : '' }}</span>
                                    <small class="d-block">{{ __('messages.Years') }}</small>
                                </div>
                                <div class="col-md-8">
                                    <h4 class="h6">{{ __('messages.The branches it serves') }}:</h4>
                                    <ul class="list-inline doctor-branch">
                                        @if(!empty($doctor->branches))
                                        @foreach($doctor->branches as $branch)
                                        <li class="list-inline-item">{{ $branch->name ? $branch->name : '' }}</li>
                                        @endforeach
                                        @endif
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- // about -->

                    <!-- journey -->
                    <div class="profile__container" id="profileJourney">
                        <h3 class="h5 title" data-aos="fade-up">
                        {{ __('messages.professional journey') }}
                        </h3>
                        <div class="section-bg" data-aos="fade-up" data-aos-delay="100">
                            <ul class="list-unstyled journey">
                                 {!! $doctor->description ? $doctor->description : '' !!}
                            </ul>
                        </div>
                    </div>
                    <!-- // journey -->

                    <!-- services -->
                    <div class="profile__container" id="profileServices">
                        <h3 class="h5 title">
                        {{ __('messages.Doctors Services') }}
                        </h3>
                        <div class="profile__services d-flex">
                        @if(!empty($doctor->specificities))
                             @foreach($doctor->specificities as $specificit)
                            <!-- service -->
                            <div class="profile__service">
                                <!-- icon -->
                                <div class="service__image">
                                    <picture>
                                        <source srcset="{{ $specificit->image ? $specificit->image : '' }}" type="image/webp"><img
                                            src="{{ $specificit->image ? $specificit->image : '' }}" draggable="false" loading="lazy" alt="service"
                                            data-aos="zoom-out">
                                    </picture>
                                </div>
                                <!-- // icon -->
                                <!-- title -->
                                <div class="service__title d-block text-center">
                                    <h4 class="h6" data-aos="fade-up">
                                    {{ $specificit->name ? $specificit->name : '' }}
                                    </h4>
                                </div>
                                <!-- // title -->
                                <!-- action -->
                                <div class="profile__service-btn" data-aos="fade-up" data-aos-delay="100">

                                    <a href="{{ url('book-an-appointment'. '/?doctor='. $doctor->id . '&service='. $doctor->service->id . '&speciality='. $specificit->id . ( app()->getLocale() != 'ar' ? ( '&lang=' . app()->getLocale()) : '')) }}" class="btn btn-brand-white Booking_ads">
                                    {{ __('messages.Book Now') }}
                                        <svg class="btn-icon">
                                            <use href="{{latest('/web/assets/images/icons/icons.svg#book')}}"></use>
                                        </svg>
                                    </a>
                                </div>
                                <!-- // action -->
                            </div>
                            <!-- // service -->
                            @endforeach
                        @endif
                        </div>
                    </div>
                    <!-- // services -->

                    <!-- cases -->
                    @if(count($casing) > 0)
                    <div class="profile__container" id="profileCases">
                        <h3 class="h5 title">
                        {{ __('messages.Cases before and after') }}
                        </h3>
                        <div class="cases">
                            <!-- case -->

                                @foreach($casing as $cas)
                                    <div class="case" data-aos="zoom-in">
                                        <div class="case__images twentytwenty-container">
                                            <picture>
                                                <source srcset="{{ $cas->image_before }}" type="image/webp"><img
                                                    src="{{ $cas->image_before }}" draggable="false" loading="lazy" alt="before">
                                            </picture>
                                            <picture>
                                                <source srcset="{{ $cas->image_after }}" type="image/webp"><img
                                                    src="{{ $cas->image_after }}" draggable="false" loading="lazy" alt="after">
                                            </picture>
                                        </div>
                                    </div>
                                @endforeach

                            <!-- // case -->
                        </div>
                        <!-- pagination -->
                        {{ $casing->appends(app()->getLocale() == 'en' ? ['lang' => 'en'] : '')->links('web.home.paginationv2') }}
                        <!-- // pagination -->
                    </div>
                    @endif
                    <!-- // cases -->

                    <!-- videos -->
                    @if(count($videos) > 0)
                    <div class="profile__container" id="profileVideos">
                        <h3 class="h5 title">
                            {{ (app()->getLocale() == 'ar') ? 'الفيديو' : 'The video'}}
                        </h3>
                        <div class="videos">
                            <!-- video -->
                            @if(!empty($videos))
                                @foreach($videos as $video)
                                <div class="video">
                                    <div class="video-modal" data-toggle="modal" data-target="#doctorVideoModal-{{ $video->id }}">
                                        <!-- thumb -->
                                        <div class="video__thumb" data-aos="zoom-in" data-aos-delay="100">
                                            <picture>
                                                <source srcset="{{ $video->image ? $video->image : '' }}" type="image/webp"><img src="{{ $video->image ? $video->image : '' }}"
                                                    draggable="false" loading="lazy" alt="video name">
                                            </picture>
                                            <div class="video__btn-container">
                                                <div class="video__btn">
                                                    <svg class="btn-icon">
                                                        <use href="{{latest('/web/assets/images/icons/icons.svg#play')}}"></use>
                                                    </svg>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- // thumb -->
                                    </div>
                                    <!-- title -->
                                    <div class="video__title">
                                        <h4 class="h6" data-aos="fade-up">
                                        {{ $video->name ? $video->name : '' }}
                                        </h4>
                                    </div>
                                    <!-- // title -->
                                </div>
                                @endforeach
                            @endif
                            <!-- // video -->
                        </div>
                        <!-- pagination -->
                             {{ $videos->appends(app()->getLocale() == 'en' ? ['lang' => 'en'] : '')->links('web.home.paginationv2') }}
                        <!-- // pagination -->
                    </div>
                    @endif
                    <!-- // videos -->
                    <!-- doctor video modal -->
                    @if(!empty($videos))
                                @foreach($videos as $video)
                        <div class="modal fade" id="doctorVideoModal-{{ $video->id }}" tabindex="-1" aria-labelledby="doctorVideoModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg modal-dialog-centered">
                                <div class="modal-content">
                                    <button type="button" class="close ml-auto" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    <div class="modal-body" id="doctorVideoModalLabel">
                                        <!-- <video src="/web/assets/videos/reviews.mp4" preload="metadata" controls></video> -->
                                        <iframe width="100%" height="500" src="{{ $video->video ? $video->video : '' }}"
                                            title="YouTube video player" frameborder="0"
                                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                            allowfullscreen></iframe>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    @endif
                    <!-- // doctor video modal -->
                </div>
                <!-- // doctors -->
            </div>
        </div>
    </section>
    <!-- // doctor profile -->


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
                    <a href="{{ url('book-an-appointment'. '/?doctor='. $doctor->id . '&service='. $doctor->service->id . ( app()->getLocale() != 'ar' ? ( '&lang=' . app()->getLocale()) : '')) }}" class="btn btn-brand-white Booking_ads" data-aos="zoom-in">
                    {{ __('messages.Book Your Appointment Now') }}
                        <svg class="btn-icon">
                            <use href="{{latest('/web/assets/images/icons/icons.svg#book')}}"></use>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </section>
    <!-- // book now -->


    <!-- doctors -->
    @if(count($servicedoctors) > 0)
    <section class="doctors d-pad">
        <div class="container">
            <!-- title -->
            <div class="title-container" data-aos="fade-up">
                <h2 class="title">
                {{ __('messages.Ram Doctors') }} <span class="color">{{ $doctor->service->name ? $doctor->service->name : '' }}</span>
                </h2>
                <a href="{{ route('web.doctors.index', app()->getLocale() == 'en' ? ['services' => $doctor->service->id ,'lang' => app()->getLocale()] : ['services' => $doctor->service->id]) }}" class="btn btn-brand-link">
                {{ __('messages.all doctors') }} {{ $doctor->service->name ? $doctor->service->name : '' }}
                    <svg class="btn-icon">
                        <use href="{{latest('/web/assets/images/icons/icons.svg#btn-arrow')}}"></use>
                    </svg>
                </a>
            </div>
            <!-- // title -->
            <!-- doctors slider -->
            <div class="swiper doctorsSlider" data-aos="fade-up" data-aos-delay="100">
                <div class="swiper-wrapper">
                    <!-- slide -->

                        @foreach($servicedoctors as $doctorserv)
                        <div class="swiper-slide">
                            <div class="doctor">
                                <!-- img -->
                                <div class="doctor__image">
                                    <picture>
                                        <source srcset="{{ $doctorserv->image ? $doctorserv->image :'' }}" type="image/webp"><img src="{{ $doctorserv->image ? $doctorserv->image :'' }}"
                                            draggable="false" alt="{{ $doctorserv->alt_image ?  $doctorserv->alt_image : ''}}">
                                    </picture>
                                </div>
                                <!-- // img -->
                                <!-- info -->
                                <div class="doctor__info">
                                    <h3 class="h5">
                                    {{ $doctorserv->name ? $doctorserv->name :'' }}
                                    </h3>
                                    <span class="doctor__department color d-block">@if(app()->getLocale() == 'ar') رام @else Ram @endif {{ $doctorserv->service->name }}</span>
                                    <span class="doctor__branch d-block">{{ implode(' ، ' , $doctorserv->branches->pluck('name')->toArray()) }}</span>
                                </div>
                                <!-- // info -->
                                <!-- actions -->
                                <div class="doctor__actions d-flex justify-content-center">
                                    <a href="{{ url('book-an-appointment'. '/?doctor='. $doctor->id . '&service='. $doctor->service->id . ( app()->getLocale() != 'ar' ? ( '&lang=' . app()->getLocale()) : '')) }}" class="btn btn-brand-primary Booking_ads">
                                    {{ __('messages.Book Now') }}
                                        <svg class="btn-icon">
                                            <use href="{{latest('/web/assets/images/icons/icons.svg#book')}}"></use>
                                        </svg>
                                    </a>
                                    <a href="{{ route('web.doctors.details', app()->getLocale() == 'en' ? ['slug' => $doctorserv->slug ,'lang' => 'en'] : ['slug' => $doctorserv->slug]) }}" class="btn btn-white">{{ __('messages.More') }}</a>
                                </div>
                                <!-- // actions -->
                            </div>
                        </div>
                        @endforeach

                    <!-- // slide -->
                </div>
                <div class="slider-controls">
                    <div class="swiper-button-next doctor-next"></div>
                    <div class="swiper-button-prev doctor-prev"></div>
                </div>
            </div>
            <!-- // doctors slider -->
        </div>
    </section>
    @endif
    <!-- // doctors -->

@endsection
