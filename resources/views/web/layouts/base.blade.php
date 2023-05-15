<!DOCTYPE html>
<html dir="{{ direction(app()->getLocale()) }}" lang="{{ app()->getLocale() }}">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- preloads -->
    <link rel="preload" href="{{latest('/web/assets2/fonts/ram-ar-regular.woff')}}" as="font" type="font/woff" crossorigin>
    <link rel="preload" href="{{latest('/web/assets2/fonts/ram-ar-regular.woff2')}}" as="font" type="font/woff2" crossorigin>
    <link rel="preload" href="{{latest('/web/assets2/fonts/ram-ar-medium.woff')}}" as="font" type="font/woff" crossorigin>
    <link rel="preload" href="{{latest('/web/assets2/fonts/ram-ar-medium.woff2')}}" as="font" type="font/woff2" crossorigin>
    <link rel="preload" href="{{latest('/web/assets2/fonts/ram-ar-bold.woff')}}" as="font" type="font/woff" crossorigin>
    <link rel="preload" href="{{latest('/web/assets2/fonts/ram-ar-bold.woff2')}}" as="font" type="font/woff2" crossorigin>
    <!-- favicons -->
    <link rel="apple-touch-icon" sizes="57x57" href="{{latest('/web/assets/images/favicons/apple-icon-57x57.png')}}">
    <link rel="apple-touch-icon" sizes="60x60" href="{{latest('/web/assets/images/favicons/apple-icon-60x60.png')}}">
    <link rel="apple-touch-icon" sizes="72x72" href="{{latest('/web/assets/images/favicons/apple-icon-72x72.png')}}">
    <link rel="apple-touch-icon" sizes="76x76" href="{{latest('/web/assets/images/favicons/apple-icon-76x76.png')}}">
    <link rel="apple-touch-icon" sizes="114x114" href="{{latest('/web/assets/images/favicons/apple-icon-114x114.png')}}">
    <link rel="apple-touch-icon" sizes="120x120" href="{{latest('/web/assets/images/favicons/apple-icon-120x120.png')}}">
    <link rel="apple-touch-icon" sizes="144x144" href="{{latest('/web/assets/images/favicons/apple-icon-144x144.png')}}">
    <link rel="apple-touch-icon" sizes="152x152" href="{{latest('/web/assets/images/favicons/apple-icon-152x152.png')}}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{latest('/web/assets/images/favicons/apple-icon-180x180.png')}}">
    <link rel="icon" type="image/png" sizes="192x192" href="{{latest('/web/assets/images/favicons/android-icon-192x192.png')}}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{latest('/web/assets/images/favicons/favicon-32x32.png')}}">
    <link rel="icon" type="image/png" sizes="96x96" href="{{latest('/web/assets/images/favicons/favicon-96x96.png')}}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{latest('/web/assets/images/favicons/favicon-16x16.png')}}">
    <link type="image/svg" href="{{latest('/web/assets/images/placeholder.svg')}}">
    <link rel="manifest" href="{{latest('/web/assets/images/favicons/manifest.json')}}">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="{{latest('/web/assets/images/favicons/ms-icon-144x144.png')}}">
    <meta name="theme-color" content="#ffffff">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link rel="stylesheet" href="{{latest('/web/assets2/css/main' .((app()->getLocale() == 'ar') ? '-rtl' : '').'.min.css')}}" crossorigin="anonymous">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.2/lazysizes.min.js" integrity="sha512-q583ppKrCRc7N5O0n2nzUiJ+suUv7Et1JGels4bXOaMFQcamPk9HjdUknZuuFjBNs7tsMuadge5k9RzdmO+1GQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!-- title and seo -->
    <title>@yield('pageTitle')</title>

    @yield('metaKeys')

    {!! $settings['code.head.allpage'][app()->getLocale()] ?? '' !!}

    @yield('styles')

    @stack('styles')

    {!! $settings['salesiq.code'][app()->getLocale()] ?? '' !!}

    @yield('TagCss')
    <style>
        .zsiq_floatmain.zsiq_theme1.siq_bR.zsiq_seasonal {
    bottom: 175px;
}
    </style>
</head>

<body>

<!-- offers slider -->
@if(\Modules\Offer\Models\Offer::where('status',2)->count() > 0)
<div class="offers-overlay-slider">
    <!-- offers logo -->
    <a href="{{ route('web.offers.index', app()->getLocale() == 'en' ? ['lang' => 'en'] : '') }}" class="offers-overlay-slider-logo d-none d-md-block">
        <picture>
            <source data-srcset="{{ latest($settings['slider.offer.logo.web'][app()->getLocale()] ?? '') }}" type="image/webp" />
            <img src="{{latest('/web/assets/images/placeholder.svg')}}" data-src="{{ latest($settings['slider.offer.logo.web'][app()->getLocale()] ?? '') }}" draggable="false" alt="offer name" loading="lazy" class="lazyload" width="150" height="200" />
        </picture>
    </a>
    <!-- // offers logo -->
    <div class="slider-close">
        <button type="button" class="close" id="offersOverlayClose">
            <span aria-hidden="true">&times;</span>
            <span class="sr-only">close</span>
        </button>
        <button type="button" class="close minimize" id="offersOverlayMinimize">
            <span aria-hidden="true">&minus;</span>
            <span aria-hidden="true">&plus;</span>
            <span class="sr-only">Minimize</span>
        </button>
    </div>
    <!-- slider -->
    <div class="swiper offersOverlaySlider" data-aos="fade-up" data-aos-delay="100">
        <div class="swiper-wrapper">
            <!-- offer -->
            @foreach(\Modules\Offer\Models\Offer::where('status',2)->with('translations', 'branche')->get() as $offer)

                <div class="swiper-slide">
                    <div class="offers-overlay">
                        <div class="offers-overlay__image">
                            <picture>
                                <source  class="lazyload" src="{{latest('/web/assets/images/placeholder.svg')}}" data-srcset="{{ latest($offer->slider_image ? $offer->slider_image : '/web/assets2/images/offers/1.webp') }}" type="image/webp">
                                <img  class="lazyload" src="{{latest('/web/assets/images/placeholder.svg')}}" data-src="{{ latest($offer->slider_image ? $offer->slider_image : '/web/assets2/images/offers/1.png') }}" draggable="false"
                                  width="150" height="200"  alt="offer name" loading="lazy">
                            </picture>
                            @if ($offer->price > 0)
                            <div class="offer-overlay__price text-center">
                                <div class="offer-overlay__price-container">
                                    <span class="d-block">{{ $offer->price }}</span>
                                    <span class="d-block">{{ $offer->branche->currency }}</span>
                                </div>
                            </div>
                            @endif
                        </div>
                        <div class="offers-overlay__text text-center">
                            <span class="overline">{{ (app()->getLocale() == 'ar') ? 'فروع رام' : 'Ram Branches'}} {{ $offer->branche->name }}</span>
                            <h2 class="h6">
                                {{ $offer->name }}
                            </h2>
                            <a href="{{ route('web.offers.book', app()->getLocale() == 'en' ? ['id' => $offer->id , 'lang' => 'en'] : ['id' => $offer->id]) }}" class="btn btn-brand-primary Booking_offer_ads">{{ __('messages.Book This Offer') }}</a>
                        </div>
                    </div>
                </div>
            @endforeach
        <!-- // offer -->
        </div>
        <div class="slider-controls">
            <div class="swiper-button-next offers-overlay-next"></div>
            <div class="swiper-button-prev offers-overlay-prev"></div>
        </div>
    </div>
    <!-- // slider -->
</div>
@endif
<!-- // offers slider -->

<!-- notification modal -->
<div class="modal fade" @if( isset($settings['hidden.notification.model.web'][app()->getLocale()]) && $settings['hidden.notification.model.web'][app()->getLocale()] == 'show') id="notificationModal" @endif tabindex="-1" aria-labelledby="notificationModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">
            <button type="button" class="close ml-auto" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <div class="modal-body" id="notificationModalLabel">
                <div class="row">
                    <!-- media -->
                    <div class="col-lg-6">
                        <div class="notification__media">{!! $settings['notification.model.videoOrimage.web'][app()->getLocale()] ?? '' !!}</div>
                    </div>
                    <!-- // media -->
                    <!-- text -->
                    <div class="col-lg-6 d-flex align-items-center">{!! $settings['notification.model.web'][app()->getLocale()] ?? '' !!}</div>
                    <!-- // text -->
                </div>
            </div>
        </div>
    </div>
</div>
<!-- // notification modal -->

<!-- search modal -->
<div class="modal fade" id="searchModal" tabindex="-1" aria-labelledby="searchModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <button type="submit" class="close ml-auto" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <div class="modal-header">
                <h4 class="modal-title" id="searchModalLabel">
                    {{ __('messages.search') }}
                </h4>
            </div>
            <div class="modal-body">
                <form method="GET" action="{{ route('web.home.search', app()->getLocale() == 'en' ? ['lang' => 'en'] : '') }}">
                    <div class="form-row">
                        <div class="form-group col-lg-9">
                            <label for="searchInput" class="sr-only">{{ __('messages.search') }}</label>
                            <input autofocus type="search"
                                   name="keyword"
                                   class="form-control"
                                   id="searchInput"
                                   value="{{ request()->keyword }}"
                                   placeholder="{{ (app()->getLocale() == 'ar') ? 'هل تبحث عن طبيب أو خدمة أو أي شئ؟' : 'Are you looking for a doctor, service or anything?'}}">

                        @if(app()->getLocale() != 'ar')
                            <input type="hidden" name="lang" value="{{ app()->getLocale() }}">
                        @endif
                        </div>
                        <div class="form-group col-lg-3">
                            <button type="submit" class="btn btn-brand-primary btn-block">{{ (app()->getLocale() == 'ar') ? 'إبحث الآن' : 'Search now'}}</button>
                        </div>

                        @error('keyword')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- // search modal -->

<!-- header -->
<header class="header" id="header">
    <!-- top bar -->
    <div class="top-bar">
        <div class="container">
            <div class="top-bar__container">
                <!-- block -->
                <div class="top-bar__block social" data-aos="fade-down">
                    <ul class="list-inline">
                        <li class="list-inline-item">
                            <a href="{{ $settings['socials.fb'][app()->getLocale()] ?? '' }}" title="Facebook">
                                <svg class="icon">
                                    <use href="{{latest('/web/assets/images/icons/icons.svg#facebook')}}"></use>
                                </svg>
                            </a>
                        </li>

                        <li class="list-inline-item">
                            <a href="{{ $settings['socials.twitter'][app()->getLocale()] ?? '' }}" title="Twitter">
                                <svg class="icon">
                                    <use href="{{latest('/web/assets/images/icons/icons.svg#twitter')}}"></use>
                                </svg>
                            </a>
                        </li>

                        <li class="list-inline-item">
                            <a href="{{ $settings['socials.insta'][app()->getLocale()] ?? '' }}" title="Instagram">
                                <svg class="icon">
                                    <use href="{{latest('/web/assets/images/icons/icons.svg#instagram')}}"></use>
                                </svg>
                            </a>
                        </li>

                        <li class="list-inline-item">
                            <a href="{{ $settings['socials.youtube'][app()->getLocale()] ?? '' }}" title="YouTube">
                                <svg class="icon">
                                    <use href="{{latest('/web/assets/images/icons/icons.svg#youtube')}}"></use>
                                </svg>
                            </a>
                        </li>

                        <li class="list-inline-item">
                            <a href="{{ $settings['socials.linkedin'][app()->getLocale()] ?? '' }}" title="LinkedIn">
                                <svg class="icon">
                                    <use href="{{latest('/web/assets/images/icons/icons.svg#linkedin')}}"></use>
                                </svg>
                            </a>
                        </li>

                        <li class="list-inline-item">
                            <a href="{{ $settings['common.whatsapp'][app()->getLocale()] ?? '' }}" title="whatsapp">
                                <img src="/web/assets/images/whatsapp.png" class="icon" alt="whatsapp">
                            </a>
                        </li>
                    </ul>
                </div>
                <!-- // block -->
                <!-- block -->
                @if( isset($settings['hidden.alert.offer.navbar'][app()->getLocale()]) && $settings['hidden.alert.offer.navbar'][app()->getLocale()] != 'd-none')
                    <a href="{{ route('web.offers.index', app()->getLocale() == 'en' ? ['lang' => 'en'] : '') }}" class="top-bar__block news d-block" data-aos="fade-down">
                        {!! $settings['alert.offer.navbar'][app()->getLocale()] ?? '' !!}
                    </a>
                @endif
                <!-- // block -->
                <!-- block -->
                <div class="top-bar__block reach" data-aos="fade-down">
                    <ul class="list-inline">
                        <li class="list-inline-item">
                            <a href="tel:{{ $settings['common.phone'][app()->getLocale()] ?? '' }}">
                                <svg class="icon">
                                    <use href="{{latest('/web/assets/images/icons/icons.svg#tel')}}"></use>
                                </svg>
                                <span class="d-none d-md-inline-block">{{ $settings['common.phone'][app()->getLocale()] ?? '' }}</span>
                            </a>
                        </li>
                        <li class="list-inline-item">
                            <a href="tel:{{ $settings['common.phone.1'][app()->getLocale()] ?? '' }}">
                                <svg class="icon">
                                    <use href="{{latest('/web/assets/images/icons/icons.svg#tel')}}"></use>
                                </svg>
                                <span class="d-none d-md-inline-block">{{ $settings['common.phone.1'][app()->getLocale()] ?? '' }}</span>
                            </a>
                        </li>
                        @yield('slug')
                    </ul>
                </div>
                <!-- // block -->
            </div>
        </div>
    </div>
    <!-- // top bar -->

    <!-- navbar -->
    <div class="header__nav container" data-aos="fade-up" data-aos-delay="200">
        <nav class="navbar navbar-expand-xl navbar-light">
            <!-- logo -->
            <a class="navbar-brand" href="{{ route('web.home.index', app()->getLocale() == 'en' ? ['lang' => 'en'] : '') }}">
                <picture>
                    <source @if($settings['ramadan.logo.option'][app()->getLocale()] == 'false') srcset="{{latest('/web/assets/images/logo.svg')}}" @else srcset="{{latest('/web/assets/images/logo2.png')}}" @endif type="image/webp" />
                    <img @if($settings['ramadan.logo.option'][app()->getLocale()] == 'false') src="{{latest('/web/assets/images/logo.svg')}}"  @else  src="{{latest('/web/assets/images/logo2.png')}}" @endif alt="ram clinics logo" width="30" height="55" />
                </picture>
            </a>
            <!-- // logo -->
            <!-- mobile icons -->
            <div class="mobile-icons">
                @yield('lang-mobile')
                <button type="button" class="btn btn-white btn-icon d-xl-none" data-toggle="modal"
                        data-target="#searchModal">
                    <span class="sr-only">{{ __('messages.search') }}</span>
                    <svg>
                        <use href="{{latest('/web/assets/images/icons/icons.svg#search')}}"></use>
                    </svg>
                </button>
                <button class="btn navbar-toggler" type="button" data-toggle="collapse" data-target="#ramNavbar"
                        aria-controls="ramNavbar" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
            </div>
            <!-- // mobile icons -->
            <!-- nav -->
            <div class="collapse navbar-collapse" id="ramNavbar">
                <ul class="navbar-nav ml-auto mr-auto">
                    <li class="nav-item {{ Route::currentRouteName() == 'web.home.index' ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('web.home.index', app()->getLocale() == 'en' ? ['lang' => 'en'] : '') }}">{{ __('messages.Home') }} <span class="sr-only">(الحالي)</span></a>
                    </li>
                    <li class="nav-item {{ Route::currentRouteName() == 'web.pages.about' ? 'active' : '' }}">
                        <a class="nav-link" href="{{ url('about-us' . ( app()->getLocale() != 'ar' ? ( '/?lang=' . app()->getLocale() ) : '')) }}">
                            @lang('messages.about')
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="javascript:void(0)" id="servicesDropdown"
                           role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            @lang('messages.Services')
                        </a>
                        <div class="dropdown-menu" aria-labelledby="servicesDropdown">
                            <a class="dropdown-item" href="{{ url(app()->getLocale() != 'ar' ? 'services?lang=en' : 'services') }}">{{ __('messages.All services') }}</a>
                            @if(!empty($servicesmanu))
                                @foreach($servicesmanu as $serv)
                                    <a class="dropdown-item" href="{{ url($serv->slug) . ( app()->getLocale() != 'ar' ? '?lang=en' : '' ) }}">
                                        @if(app()->getLocale() == 'ar') خدمات @else Services @endif {{ $serv->name }}
                                    </a>
                                @endforeach
                            @endif
                        </div>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="javascript:void(0)" id="offersDropdown"
                           role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                           @lang('messages.Offers')
                        </a>
                        <div class="dropdown-menu" aria-labelledby="offersDropdown">
                            <a class="dropdown-item" href="{{ route('web.offers.index', app()->getLocale() == 'en' ? ['lang' => 'en'] : '') }}">{{ (app()->getLocale() == 'ar') ? 'كل العروض' : 'All offers'}}</a>
                            <a class="dropdown-item" href="{{ route('web.offers.terms', app()->getLocale() == 'en' ? ['lang' => 'en'] : '') }}">{{ (app()->getLocale() == 'ar') ? 'الشروط واﻷحكام' : 'Terms and Conditions'}}</a>
                        </div>
                    </li>

                    <li class="nav-item {{ Route::currentRouteName() == 'web.leads.index' ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('web.leads.index', app()->getLocale() == 'en' ? ['lang' => 'en'] : '') }}">@lang('messages.installment')</a>
                    </li>

                    <li class="nav-item {{ Route::currentRouteName() == 'web.discounts.index' ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('web.discounts.index', app()->getLocale() == 'en' ? ['lang' => 'en'] : '') }}">@lang('messages.Partners Discount')</a>
                    </li>

                    <li class="nav-item {{ Route::currentRouteName() == 'web.doctors.index' ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('web.doctors.index', app()->getLocale() == 'en' ? ['lang' => 'en'] : '') }}">@lang('messages.Doctors')</a>
                    </li>

                    @if(app()->getLocale() != 'en')
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="javascript:void(0)" id="blogDropdown" role="button"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                @lang('messages.News and Articles')
                            </a>
                            <div class="dropdown-menu" aria-labelledby="blogDropdown">
                                <a class="dropdown-item" href="{{ url('blogs' . ( app()->getLocale() != 'ar' ? ( '/?lang=' . app()->getLocale() ) : '')) }}">{{ __('messages.All articles') }}</a>
                                @foreach(\Modules\Blog\Models\BlogCategory::with('translations')->get() as $blogCategory)
                                    <a class="dropdown-item" href="{{ url($blogCategory->slug ?? '') . ( app()->getLocale() != 'ar' ? '?lang=en' : '' ) }}">
                                        {{ $blogCategory->name }}
                                    </a>
                                @endforeach
                            </div>
                        </li>
                    @endif

                    <li class="nav-item {{ Route::currentRouteName() == 'web.branches.index' ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('web.branches.index', app()->getLocale() == 'en' ? ['lang' => 'en'] : '') }}">@lang('messages.Branches')</a>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="javascript:void(0)" id="contactDropdown"
                           role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            @lang('messages.Contact Us')
                        </a>
                        <div class="dropdown-menu" aria-labelledby="contactDropdown">
                            <!-- <a class="dropdown-item" href="{{ url('careers' . ( app()->getLocale() != 'ar' ? ( '/?lang=' . app()->getLocale() ) : '')) }}">{{ __('messages.Jobs') }}</a> -->
                            <a class="dropdown-item" href="{{ url('contact-us' . ( app()->getLocale() != 'ar' ? ( '/?lang=' . app()->getLocale() ) : '')) }}">
                                @lang('messages.Contact Us')
                            </a>
                            <a class="dropdown-item" href="{{ route('web.leads.rate', app()->getLocale() == 'en' ? ['lang' => 'en'] : '') }}">
                            {{ (app()->getLocale() == 'ar') ? 'قيم زيارتك' : 'Survey'}}
                            </a>
                        </div>
                    </li>
                </ul>
                <!-- actions -->
                <div class="my-2 my-lg-0 d-xl-inline-block">
                    <button type="button" class="btn btn-white d-none d-xl-inline-block" data-toggle="modal" data-target="#searchModal">
                        <span class="sr-only">@lang('messages.search')</span>
                        <svg class="btn-icon"><use href="{{latest('/web/assets/images/icons/icons.svg#search')}}"></use></svg>
                    </button>
                    <a href="{{ url('book-an-appointment' . ( app()->getLocale() != 'ar' ? ( '/?lang=' . app()->getLocale() ) : '')) }}" class="btn btn-brand-primary Booking_ads">
                        @lang('messages.Book Now')
                        <svg class="btn-icon"><use href="{{latest('/web/assets/images/icons/icons.svg#book')}}"></use></svg>
                    </a>
                </div>
                <!-- // actions -->
            </div>
            <!-- // nav -->
        </nav>
    </div>
    <!-- // navbar -->
</header>
<!-- // header -->

@yield('content')

<!-- partners -->
<section class="partners d-pad text-center {{ (app()->getLocale() == 'en') ? 'mt-5' : '' }}">
    <div class="container">
        <h2 class="title" data-aos="fade-up">
            @if(app()->getLocale() == 'ar')
                شركاء
                <span class="color">النجاح</span>
            @else
                <span class="color">Success</span>
                 partners
            @endif
        </h2>
        <div class="swiper partnersSlider" data-aos="fade-up" data-aos-delay="100">
            <div class="swiper-wrapper">
                @foreach(\Modules\Partner\Models\Partner::get() as $partner)
                    <div class="swiper-slide">
                        <div class="partner">
                            <div class="partner__image d-flex align-items-center justify-content-center">
                                <picture>
                                    <source class="lazyload" src="{{latest('/web/assets/images/placeholder.svg')}}" data-srcset="{{ $partner->image }}" type="image/webp" />
                                    <img class="lazyload" src="{{latest('/web/assets/images/placeholder.svg')}}" data-src="{{ $partner->image }}" draggable="false" loading="lazy" alt="alt" width="107" height="40" />
                                </picture>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="slider-controls">
                <div class="swiper-button-next partner-next"></div>
                <div class="swiper-button-prev partner-prev"></div>
            </div>
        </div>
    </div>
</section>
<!-- // partners -->

<!-- offers end -->

<a href="{{ $settings['url.counter.slider'][app()->getLocale()] ?? '#' }}" class="offers-end text-center {{ $settings['counter.slider'][app()->getLocale()] }}">
    <h2 class="h6 color" id="counterEnd">{{ __('messages.offers_counter_title') }}</h2>
    <div class="counters d-flex justify-content-center" id="counters">
        <!-- counter -->
        <div class="counter">
            <div class="counter__number" id="jsSeconds">0</div>
            <div class="counter__title">{{ __('messages.sec') }}</div>
        </div>
        <!-- // counter -->
        <!-- counter -->
        <div class="counter">
            <div class="counter__number" id="jsMinutes">0</div>
            <div class="counter__title">{{ __('messages.min') }}</div>
        </div>
        <div class="counter">
            <div class="counter__number" id="jsHours">0</div>
            <div class="counter__title">{{ __('messages.hour') }}</div>
        </div>
        <div class="counter">
            <div class="counter__number" id="jsDay">0</div>
            <div class="counter__title">{{ __('messages.Day') }}</div>
        </div>
        <!-- // counter -->
    </div>
</a>


<!-- footer -->
<footer class="footer">
    <div class="container">
        <div class="row">
            <!-- logo -->
            <div class="col-xl-1">
                <div class="footer__logo" data-aos="fade-up">
                    <picture>
                        <source @if($settings['ramadan.logo.option'][app()->getLocale()] == 'false') srcset="{{latest('/web/assets/images/logo.svg')}}" @else srcset="{{latest('/web/assets/images/logo2.png')}}" @endif type="image/webp" />
                        <img @if($settings['ramadan.logo.option'][app()->getLocale()] == 'false') src="{{latest('/web/assets/images/logo.svg')}}"  @else  src="{{latest('/web/assets/images/logo2.png')}}" @endif draggable="false" loading="lazy" alt="logo" width="50" height="80" />
                    </picture>
                </div>
            </div>
            <!-- // logo -->
            <!-- links -->
            <div class="col-xl-7">
                <div class="footer__list-container">
                    <div class="footer__list" data-aos="fade-up">
                        <h6>{{ (app()->getLocale() == 'ar') ? 'الوصول السريع' : 'Quick access'}}:</h6>
                        <ul class="list-unstyled">
                            <li><a href="{{ route('web.home.index', app()->getLocale() == 'en' ? ['lang' => 'en'] : '') }}">{{ __('messages.Home') }}</a></li>
                            <li><a href="{{ url('about-us' . ( app()->getLocale() != 'ar' ? ( '/?lang=' . app()->getLocale() ) : '')) }}">{{ __('messages.about') }}</a></li>
                            <li><a href="{{ route('web.leads.index', app()->getLocale() == 'en' ? ['lang' => 'en'] : '') }}">{{ __('messages.installment') }}</a></li>
                            <li><a href="{{ route('web.discounts.index', app()->getLocale() == 'en' ? ['lang' => 'en'] : '') }}">{{ __('messages.Partners Discount') }}</a></li>
                            <li><a href="{{ route('web.doctors.index', app()->getLocale() == 'en' ? ['lang' => 'en'] : '') }}">{{ __('messages.Doctors') }}</a></li>
                            <li><a href="{{ url('blogs' . ( app()->getLocale() != 'ar' ? ( '/?lang=' . app()->getLocale() ) : '')) }}">{{ __('messages.News and Articles') }}</a></li>
                        </ul>
                    </div>
                    <div class="footer__list" data-aos="fade-up">
                        <h6>{{ __('messages.Services') }}:</h6>
                        <ul class="list-unstyled">
                            @if(!empty($servicesmanu))
                                @foreach($servicesmanu as $serv)
                                    <li>
                                        <a href="{{ url($serv->slug) . ( app()->getLocale() != 'ar' ? '?lang=en' : '' ) }}">
                                            @if(app()->getLocale() == 'ar') خدمات @else Services @endif {{ $serv->name }}
                                        </a>
                                    </li>
                                @endforeach
                            @endif
                            <li><a href="{{ route('web.offers.index', app()->getLocale() == 'en' ? ['lang' => 'en'] : '') }}">{{ __('messages.Offers') }}</a></li>
                            <li><a href="{{ route('web.branches.index', app()->getLocale() == 'en' ? ['lang' => 'en'] : '') }}">{{ __('messages.Branches') }}</a></li>
                        </ul>
                    </div>
                    <div class="footer__list" data-aos="fade-up">
                        <h6>{{ __('messages.Contact Us') }}:</h6>
                        <ul class="list-unstyled">
                            <!-- <li><a href="{{ url('careers' . ( app()->getLocale() != 'ar' ? ( '/?lang=' . app()->getLocale() ) : '')) }}">{{ __('messages.Jobs') }}</a></li> -->
                            <li><a href="{{ url('contact-us' . ( app()->getLocale() != 'ar' ? ( '/?lang=' . app()->getLocale() ) : '')) }}">{{ __('messages.Contact Us') }}</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- // links -->
            <!-- form -->
            <div class="col-xl-4">
                <!-- form -->
                <div class="footer__form" data-aos="fade-up">
                    <h6>{{ __('messages.Subscribe now') }}:</h6>
                    <form class="subscribe" method="POST" action="{{ route('web.home.subscribe', app()->getLocale() == 'en' ? ['lang' => 'en'] : '') }}">
                        @csrf
                        <div class="form-group">
                            <label for="subscribeForm" class="sr-only">{{ (app()->getLocale() == 'ar') ? 'أدخل رقم الجوال' : 'Enter the mobile number'}}</label>
                            <span class="form-icon">
                                        <svg class="icon">
                                            <use href="{{latest('/web/assets/images/icons/icons.svg#iphone')}}"></use>
                                        </svg>
                                    </span>
                            <input type="tel" name="phone" class="form-control" id="subscribeForm"  onchange="validateSubContact(this)" maxlength="10" placeholder="{{ (app()->getLocale() == 'ar') ? 'أدخل رقم الجوال' : 'Enter the mobile number'}} (05xxxxxxxx)." required>

                            <button class="btn btn-brand-primary">{{ (app()->getLocale() == 'ar') ? 'إشترك' : 'Subscribe'}}</button>

                            <div class="invalid-feedback">
                                {{ (app()->getLocale() == 'ar') ? 'يجب أن يكون هذا الحقل جوالًا سعوديًا (05xxxxxxxx).' : 'This field must be saudi arabia mobile (05xxxxxxxx).'}}
                            </div>
                        </div>
                    </form>
                </div>
                <!-- // form -->
                <!-- social -->
                <div class="footer__social" data-aos="fade-up">
                    <h6>{{ (app()->getLocale() == 'ar') ? 'تابعنا على وسائل التواصل الإجتماعي' : 'Follow us on social media'}}</h6>
                    <div class="social">
                        <ul class="list-inline">
                            <li class="list-inline-item">
                                <a href="{{ $settings['socials.fb'][app()->getLocale()] ?? '' }}" title="Facebook">
                                    <svg class="icon">
                                        <use href="{{latest('/web/assets/images/icons/icons.svg#facebook')}}"></use>
                                    </svg>
                                </a>
                            </li>

                            <li class="list-inline-item">
                                <a href="{{ $settings['socials.twitter'][app()->getLocale()] ?? '' }}" title="Twitter">
                                    <svg class="icon">
                                        <use href="{{latest('/web/assets/images/icons/icons.svg#twitter')}}"></use>
                                    </svg>
                                </a>
                            </li>

                            <li class="list-inline-item">
                                <a href="{{ $settings['socials.insta'][app()->getLocale()] ?? '' }}" title="Instagram">
                                    <svg class="icon">
                                        <use href="{{latest('/web/assets/images/icons/icons.svg#instagram')}}"></use>
                                    </svg>
                                </a>
                            </li>

                            <li class="list-inline-item">
                                <a href="{{ $settings['socials.youtube'][app()->getLocale()] ?? '' }}" title="YouTube">
                                    <svg class="icon">
                                        <use href="/web/assets/images/icons/icons.svg#youtube"></use>
                                    </svg>
                                </a>
                            </li>

                            <li class="list-inline-item">
                                <a href="{{ $settings['socials.linkedin'][app()->getLocale()] ?? '' }}" title="LinkedIn">
                                    <svg class="icon">
                                        <use href="{{latest('/web/assets/images/icons/icons.svg#linkedin')}}"></use>
                                    </svg>
                                </a>
                            </li>

                            <li class="list-inline-item">
                                <a href="{{ $settings['common.whatsapp'][app()->getLocale()] ?? '' }}" title="whatsapp">
                                    <img src="/web/assets/images/whatsapp.png" class="icon" alt="whatsapp">
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- social -->
            </div>
            <!-- // form -->
        </div>
    </div>
    <!-- copyrights -->
    <div class="footer__copyrights text-center">
        <small>
            &copy; {{ (app()->getLocale() == 'ar') ? '2021. جميع الحقوق محفوظة لـ عيادات رام.' : '2021. All rights reserved to Ram Clinics.'}}
        </small>
    </div>
    <!-- // copyrights -->
</footer>
<!-- // footer -->
{!! $settings['code.foot.allpage'][app()->getLocale()] ?? '' !!}
<!-- js files -->
<script src="{{latest('/web/assets2/js/main.min.js')}}"></script>

@routes

@yield('submit.scripts')

<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.js?ver=1.1"></script>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.css?ver=1.1">

    @if(Session::has('success'))
       @if(app()->getLocale() == 'ar')
        <script>
            toastr.options.positionClass = 'toast-top-right';
            toastr.success("{{ Session::get('success') }}");
        </script>
        @else
        <script>
            toastr.options.positionClass = 'toast-top-left';
            toastr.success("{{ Session::get('success') }}");
        </script>
        @endif

    @elseif(Session::has('error'))
        @if(app()->getLocale() == 'ar')
        <script>
            toastr.options.positionClass = 'toast-top-right';
            toastr.error("{{ Session::get('error') }}");
        </script>
         @else
         <script>
            toastr.options.positionClass = 'toast-top-left';
            toastr.error("{{ Session::get('error') }}");
        </script>
         @endif
    @endif

<script type='text/javascript'>
    function validateSubContact(tel) {

        var xyz=document.getElementById('subscribeForm').value.trim();

        var  phoneno = /^\d{10}$/;
        if((tel.value.match(phoneno)) && tel.value.length == 10 && xyz.substr(0,2)==='05' && $.isNumeric(xyz))
        {
            $(tel).removeClass('is-invalid');
            $(tel).addClass('is-valid');

        } else {
            $("#subscribeForm").val('');
            $(tel).removeClass('is-valid');
            $(tel).addClass('is-invalid');

        }
    }
</script>
@if(empty($settings['counter.slider'][app()->getLocale()]))
<script type='text/javascript'>
    // date
    var countDownDate = new Date("2022/12/31 22:59:59").getTime();


    // update count every 1 second
    var x = setInterval(function () {
        var now = new Date().getTime();
        var distance = countDownDate - now;
        var _second = 1000;
        var _minute = _second * 60;
        var _hour = _minute * 60;
        var _day = _hour * 24;
        var remaining_days = Math.floor(distance / (1000 * 60 * 60 * 24));
        var _days = remaining_days * 24;

        // var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        var hours = Math.floor((distance % _day) / _hour) + _days;
        // add days
        var days = Math.floor(hours/24);
        hours = hours - ( days * 24);

        var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        var seconds = Math.floor((distance % (1000 * 60)) / 1000);

        // output
        document.getElementById("jsDay").innerHTML = days;
        document.getElementById("jsHours").innerHTML = hours;
        document.getElementById("jsMinutes").innerHTML = minutes;
        document.getElementById("jsSeconds").innerHTML = seconds;

        // when counter over
        if (distance <= 0) {
            clearInterval(x);
            document.getElementById("counters").className = "d-none";
            document.getElementById("counterEnd").innerHTML = "{{ __('messages.offers_expired') }}";
        }
    }, 1000);
</script>
@endif
@stack('js')

@if($errors->has('keyword'))
    <script>
        $('#searchModal').modal('show');
    </script>
@endif

</body>

</html>
