@extends('web.layouts.base')

@section('styles')
    <link rel="stylesheet preload" href="{{latest('/web/assets2/css/services'.((app()->getLocale() == 'ar') ? '-rtl' : '').'.min.css')}}" as="style" crossorigin>

@endsection


@section('pageTitle', $settings['metatitle.services'][app()->getLocale()] ?? __('messages.Ram Services') )

@section('metaKeys')
    {!! $settings['services.ceo'][app()->getLocale()] ?? '' !!}
@endsection

@section('slug')
    <li class="list-inline-item d-none d-xl-inline-block">
        <a href="{{ url(app()->getLocale() != 'ar' ? 'services' : 'services?lang=en') }}" class="lang">
            {{ app()->getLocale() != 'ar' ? __('messages.ar') : __('messages.en') }}
        </a>
    </li>
@endsection

@section('lang-mobile')
    <a href="{{ url(app()->getLocale() != 'ar' ? 'services' : 'services?lang=en') }}" class="d-xl-none lang">
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
                    <source srcset="{{latest('/web/assets/images/page-header.webp')}}" type="image/webp" />
                    <img src="{{latest('/web/assets/images/page-header.jpg')}}" draggable="false" alt="page image" data-aos="zoom-out" />
                </picture>
            </div>
            <!-- // image -->
            <!-- title -->
            <h1 class="h3" data-aos="fade-up" data-aos-delay="100">@lang('messages.Ram Services')</h1>
            <!-- title -->
        </div>
    </div>
    <!-- // page header -->


    <!-- services -->
    <section class="services d-pad">
        <div class="container">
            <!-- title -->
            <div class="section-title">{!! $settings['services.about.page'][app()->getLocale()] ?? '' !!}</div>
            <!-- // title -->
            <!-- services -->
            <div class="services__container" data-aos="fade-up" data-aos-delay="300">
                <!-- services -->
                @if(!empty($services))
                    @foreach($services as $serv)
                        <a href="{{ url($serv->slug) . ( app()->getLocale() != 'ar' ? '?lang=en' : '' ) }}" class="service d-block">
                            <div class="service__image" data-aos="zoom-out">
                                <picture>
                                    <source srcset="{{ $serv->image }}" type="image/webp" />
                                    <img src="{{ $serv->image }}" draggable="false" loading="lazy" alt="{{ $serv->alt_image ? $serv->alt_image : '' }}" />
                                </picture>
                            </div>
                            <div class="service__title">
                                <h3 class="h5">
                                    <span class="color"> @if(app()->getLocale() == 'ar') خدمات @else Services @endif </span> {{ $serv->name }}
                                </h3>
                            </div>
                        </a>
                @endforeach
            @endif
            <!-- // services -->
            </div>
        </div>
    </section>
    <!-- // services -->

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
    <section class="doctors d-pad">
        <div class="container">
            <!-- title -->
            <div class="title-container" data-aos="fade-up">
                <h2 class="title">
                    @if(app()->getLocale() == 'ar')
                        أطباء <span class="color">عيادات رام</span>
                    @else
                        Ram Clinics <span class="color">Doctors</span>
                    @endif
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
                    <!-- slide -->
                    @if(!empty($doctors))
                        @foreach($doctors as $doctor)
                            <div class="swiper-slide">
                                <div class="doctor">
                                    <!-- img -->
                                    <div class="doctor__image">
                                        <picture>
                                            <source srcset="{{ $doctor->image ? $doctor->image :'' }}" type="image/webp" />
                                            <img src="{{ $doctor->image ? $doctor->image :'' }}" draggable="false" alt="alt" />
                                        </picture>
                                    </div>
                                    <!-- // img -->
                                    <!-- info -->
                                    <div class="doctor__info">
                                        <h3 class="h5">{{ $doctor->name ? $doctor->name :'' }}</h3>
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
                    @endforeach
                @endif
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
    <!-- // doctors -->

    @if(app()->getLocale() != 'en')
    <!-- blog -->
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
                                    <img src="{{ $article->image }}" draggable="false" loading="lazy" alt="alt" />
                                </picture>
                            </a>
                            <div class="blog__article-info">
                                <a href="{{ url($article->category->slug ?? '') . ( app()->getLocale() != 'ar' ? '?lang=en' : '' ) }}" class="overline">{{ $article->category->name }}</a>
                                <a href="{{ $article->blogDetailsLink }}">
                                    <h3 class="h5">{{ $article->name }}</h3>
                                    <p>
                                        <?php
                                            $brief = strip_tags($article->content);
                                            echo substr($brief, 0, 300) . " ...";
                                        ?>
                                    </p>
                                    <span class="date small">
                                    {{ \Carbon\Carbon::parse($article->created_at)->diffForHumans() }}
                                </span>
                                </a>
                            </div>
                        </div>
                    </div>
                    <!-- // article -->
                @endforeach
            </div>
        </div>
    </section>
    <!-- // blog -->
    @endif
@endsection

