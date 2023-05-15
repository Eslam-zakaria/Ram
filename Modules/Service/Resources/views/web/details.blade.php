@extends('web.layouts.base')

@section('styles')
    <link rel="stylesheet preload" href="{{latest('/web/assets2/css/services'.( (app()->getLocale() == 'ar') ? '-rtl' : '').'.min.css')}}" as="style" crossorigin>

@endsection

@section('pageTitle')
    {{ $service->meta_title ? $service->meta_title : $service->name }}
@endsection

@section('metaKeys')
    <meta property="og:title" content="{{ $service->name ?? '' }}"/>
    <meta property="og:description" content="{{ $service->meta_description ?? '' }}" />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="{{ url()->current() ?? '' }}"/>
    <meta property="og:image" content="{{ $service->image ?? '/web/assets/images/logo.svg' }}"/>

    <!-- Meta description for twitter. -->
    <meta name="twitter:card" content="{{ $service->image ?? '/web/assets/images/logo.svg' }}">
    <meta name="twitter:site" content="{{ url('/') }}">
    <meta name="twitter:title" content="{{ $service->name ?? '' }}"/>
    <meta name="twitter:description" content="{{ $service->meta_description ?? '' }}" />
    <meta name="twitter:image" content="{{ $service->image ?? '/web/assets/images/logo.svg' }}" />

    <meta name="title" content="{{ $service->meta_title ? $service->meta_title : '' }}" />
    <meta name="description" content="{{ $service->meta_description ? $service->meta_description : '' }}" />
    <meta name="keywords" content="{{ $service->meta_keywords  ? $service->meta_keywords : ''}}" />
    <link rel="canonical" href="{{ $service->canonical_url ? $service->canonical_url : '' }}" />
@endsection

@section('slug')
    @if(app()->getLocale() == 'ar')
        <li class="list-inline-item d-none d-xl-inline-block">
            <a href="{{ url($service->translate('en')->slug) . '?lang=en' }}" class="lang">
                English
            </a>
        </li>
    @else
        <li class="list-inline-item d-none d-xl-inline-block">
            <a href="{{ url($service->translate('ar')->slug) }}" class="lang">
                عربي
            </a>
        </li>
    @endif
@endsection

@section('lang-mobile')
    @if(app()->getLocale() == 'ar')
        <a href="{{ url($service->translate('en')->slug) . '?lang=en' }}" class="d-xl-none lang">English</a>
    @else
        <a href="{{ url($service->translate('ar')->slug) }}" class="d-xl-none lang">عربي</a>
    @endif
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
            <h1 class="h3" data-aos="fade-up" data-aos-delay="100">
                {{ __('messages.Ram Services') }} {{ $service->name ? $service->name : '' }}
            </h1>
            <!-- title -->
        </div>
    </div>
    <!-- // page header -->


    <!-- services details -->
    <section class="services-details d-pad">
        <div class="container">
            <!-- title -->
            <div class="section-title">{!! $service->description ?? '' !!}</div>
            <!-- // title -->
        </div>
    </section>
    <!-- // services details -->


    <!-- services slider -->
    @if(count($service->specialities) > 0)
        <div class="services-slider">
            <div class="container">
                <nav>
                    <div class="nav nav-pills" id="nav-tab" data-aos="fade-up">
                        <div class="swiper servicesSlider">
                            <div class="swiper-wrapper">
                                <!-- service slide -->
                                @foreach($service->specialities as $special)
                                    <div class="swiper-slide">
                                        <a @if($special->slug) href="{{ route('web.subservices.details', app()->getLocale() == 'en' ? ['slug' => $special->slug , 'lang' => 'en'] : ['slug' => $special->slug ]) }}" @endif>
                                        {{-- <a class="nav-link {{ $loop->first ? 'active' : '' }} service_slider" data-tab="service_tab_{{ $special->id }}"> --}}
                                            <!-- image -->
                                            <div class="service__image" data-aos="zoom-out">
                                                <picture>
                                                    <source srcset="{{ $special->icon ? $special->icon : '' }}" type="image/webp" />
                                                    <img src="{{ $special->icon ? $special->icon : '' }}" draggable="false" loading="lazy" alt="{{ $special->alt_image ? $special->alt_image : '' }}" />
                                                </picture>
                                            </div>
                                            <!-- // image -->
                                            <!-- title -->
                                            <div class="service__title d-block text-center" data-aos="zoom-in-up" data-aos-delay="200">
                                                <h2 class="h6">{{ $special->name ? $special->name : '' }}</h2>
                                            </div>
                                            <!-- // title -->
                                        </a>
                                    </div>
                                @endforeach
                                <!-- // service slide -->
                            </div>
                            <div class="slider-control">
                                <div class="swiper-button-next service-next"></div>
                                <div class="swiper-button-prev service-prev"></div>
                            </div>
                        </div>
                    </div>
                    <!-- services content -->
                    {{-- <div class="tab-content d-none" id="nav-tabContent">
                        <!-- service 1 -->
                        @foreach($service->specialities as $special)
                            <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }} service_tab" id="service_tab_{{ $special->id }}">
                                <div class="service__content">
                                    <div class="row">
                                        <!-- text -->
                                        <div class="col-lg-6 col-xl-7">
                                            <div class="service__content-text">
                                                <h3 class="h4" data-aos="fade-up">{{ $special->name ?? '' }}</h3>
                                                <p data-aos="fade-up" data-aos-delay="100">{!! $special->description ?? '' !!}</p>
                                                <ul class="list-unstyled" data-aos="fade-up" data-aos-delay="200">
                                                    @foreach($special->enabledcategories as $subspecial)
                                                        <li>{{ $subspecial->name ? $subspecial->name : '' }}</li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                            <div class="book-btn" data-aos="fade-up" data-aos-delay="300">
                                                <a href="{{ url('book-an-appointment'. '/?service='. $service->id . '&speciality='. $special->id . ( app()->getLocale() != 'ar' ? ( '&lang=' . app()->getLocale()) : '')) }}" class="btn btn-brand-primary Booking_ads">
                                                    {{ __('messages.Book Now') }}
                                                    <svg class="btn-icon">
                                                        <use href="{{latest('/web/assets/images/icons/icons.svg#book')}}"></use>
                                                    </svg>
                                                </a>
                                            </div>
                                        </div>
                                        <!-- // text -->
                                        <!-- image -->
                                        <div class="col-lg-6 col-xl-5">
                                            <div class="service__content-image">
                                                <picture>
                                                    <source srcset="{{ $special->image ? $special->image : '' }}" type="image/webp"><img
                                                        src="{{ $special->image ? $special->image : '' }}" draggable="false" loading="lazy" alt="{{ $special->alt_brief_image ? $special->alt_brief_image : '' }}"
                                                        data-aos="zoom-out">
                                                </picture>
                                            </div>
                                        </div>
                                        <!-- // image -->
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        <!-- // service 1 -->
                    </div> --}}
                    <!-- services content -->
                </nav>
            </div>
        </div>
    @endif
    <!-- // services slider -->

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
                    <a href="{{ url('book-an-appointment'. '/?service='. $service->id . ( app()->getLocale() != 'ar' ? ( '&lang=' . app()->getLocale()) : '')) }}" class="btn btn-brand-white Booking_ads" data-aos="zoom-in">
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
                        {{ __('messages.Ram Doctors') }} <span class="color">{{ $service->name ? $service->name : '' }}</span>
                    </h2>
                    <a href="{{ route('web.doctors.index', app()->getLocale() == 'en' ? ['services' => $service->id , 'lang' => 'en'] : ['services' => $service->id ]) }}" class="btn btn-brand-link">
                        {{ __('messages.all doctors') }} {{ $service->name ? $service->name : '' }}
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
                                            <source srcset="{{ $doctorserv->image ? $doctorserv->image :'' }}" type="image/webp">
                                            <img src="{{ $doctorserv->image ? $doctorserv->image :'' }}" draggable="false" alt="{{ $doctorserv->alt_image ? $doctorserv->alt_image :'' }}">
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
                                        <a href="{{ url('book-an-appointment'. '/?doctor='. $doctorserv->id . ( app()->getLocale() != 'ar' ? ( '&lang=' . app()->getLocale()) : '')) }}" class="btn btn-brand-primary Booking_ads">
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
    @if(app()->getLocale() != 'en')
    <!-- blog -->
    <section class="blog d-pad">
        <div class="container">
            <!-- title -->
            <div class="title-container" data-aos="fade-up">
                <h2 class="title">
                    {{ (app()->getLocale() == 'ar') ? 'أحدث' : 'Latest'}} <span class="color">{{ (app()->getLocale() == 'ar') ? 'المقالات' : 'Articles'}}</span>
                </h2>
                <a href="{{ url(app()->getLocale() != 'ar' ? 'blogs?lang=en' : 'blogs') }}" class="btn btn-brand-link">
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
                                <a @if($article->category->slug) href="{{ url($article->category->slug ?? '') . ( app()->getLocale() != 'ar' ? '?lang=en' : '' ) }}" @endif class="overline">
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
    <!-- // blog -->
    @endif
@stop

@section('submit.scripts')
    <script>
        $(document).on('click', '.service_slider', function (){

            $('.service_slider').removeClass('active');

            $(this).addClass('active');

            $('.service_tab').removeClass('show active');

            $("#"+$(this).data('tab')).addClass('show active');
        });
    </script>
@stop
