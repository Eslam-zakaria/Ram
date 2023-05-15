@extends('Page.Resources.views.ram.base')
@section('scripts')
    {!!  settings()->get('pages.scripts') !!}
@endsection
@section('content')

    <!-- navbar -->
    <div class="main-navbar fixed-top">
        <div class="container">
            <nav class="navbar navbar-light navbar-expand-lg">
                <!-- logo -->
                <a class="navbar-brand" href="index.html">
                    <img src="{{latest('/web/assets/images/logo.svg')}}" alt="عيادات رام" draggable="false">
                </a>
                <!-- // logo -->
                <!-- mobile toggle & book button -->
                <div class="mobile-nav">
                    <div class="book-btn d-lg-none">
                        <a href="#book" class="btn btn-brown">{{ trans_choice('messages.choosenow', $page->gender) }}</a>
                    </div>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ram-navbar"
                            aria-controls="ram-navbar" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                </div>
                <!-- // mobile toggle -->
                <!-- nav -->
                <div class="collapse navbar-collapse" id="ram-navbar">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="#services">
                                خدماتنا
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#offers">
                                العروض
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#reviews">
                                آراء عملائنا
                            </a>
                        </li>
                    </ul>
                </div>
                <!-- nav -->
                <!-- book button desktop -->
                <div class="book-btn d-none d-lg-block">
                    <a href="#book" class="btn btn-brown"> {{ trans_choice('messages.choosenow', $page->gender) }}</a>
                </div>
                <!-- book button desktop -->
            </nav>
        </div>
    </div>
    <!-- // navbar -->


    <!-- hero -->
    <div class="hero">
        <div class="container" id="form-contsainer">
            <div class="row">
                <div class="col-lg-6">
                    <!-- book -->
                    <div class="main__book" data-aos="zoom-in-up" data-aos-duration="600">
                        <div class="book-block text-center">
                            @if($page->discount_url)
                                <a  class="book-block__title d-block" href="{{ $page->discount_url }}" style="font-size: 17.5px">
                            @else
                                <div  class="book-block__title d-block" style="cursor: default; font-size: 17.5px">
                            @endif
                                {{ $page->discount_text }}
                                @if($page->discount_percent)
                                    <span class="en">
                                        {{ $page->discount_percent }}
                                    </span>
                                @endif
                            @if($page->discount_url)
                                </a>
                            @else
                                </div>
                            @endif
                            <div class="book-block__form">
                                @include('Page.Resources.views.ram.form')
                            </div>
                        </div>
                    </div>
                    <!-- // book -->
                    <!-- text -->
                    <div class="hero__text text-center">
                        {!!  $page->description !!}
                    </div>
                    <!-- // text -->
                </div>
                <!-- photo -->
                <div class="col-lg-6">
                    <div class="hero__photo">
                        <div class="hero__photo-big">
                            <img src="{{ $page->image }}" class="img-fluid" alt="hero photo" draggable="false">
                        </div>
                        <div class="hero__photo-ins text-center" data-aos="zoom-in-up" data-aos-delay="200"
                             data-aos-duration="600">
                            مع إمكانية
                            <br>
                            التقسيط
                            <span class="color d-block">
                                0%
                            </span>
                            أربـــاح
                        </div>
                    </div>
                </div>
                <!-- // photo -->
            </div>
        </div>
    </div>
    <!-- // hero -->


    <!-- features -->
    <div class="features text-center">
        <div class="container">
            <div class="row">
                <div class="col-lg-2"></div>
                <div class="col-lg-8">
                    <div class="row">
                        <!-- feature -->
                        <div class="col-lg-4" data-aos="fade-up" data-aos-delay="0" data-aos-duration="600">
                            <div class="feature">
                                <div class="feature__icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="56" height="56" viewBox="0 0 56 56">
                                        <g id="doctor" transform="translate(1721 -1562)">
                                            <path id="Path_24" data-name="Path 24"
                                                  d="M64.787,19.932H58.54v3.9h4.3v7.354a11.715,11.715,0,1,1-23.429,0V23.837h4.165v-3.9H37.453A1.952,1.952,0,0,0,35.5,21.884v9.307a15.619,15.619,0,0,0,31.239,0V21.884A1.952,1.952,0,0,0,64.787,19.932Z"
                                                  transform="translate(-1751.501 1545.151)" fill="#94c023" />
                                            <path id="Path_25" data-name="Path 25"
                                                  d="M187.863,262.628v9.242a9.762,9.762,0,0,1-19.524,0V259.114h-3.9V271.87a13.667,13.667,0,1,0,27.334,0v-9.242Z"
                                                  transform="translate(-1866.962 1330.96)" fill="#94c023" />
                                            <path id="Path_26" data-name="Path 26"
                                                  d="M345.441,171.912a7.224,7.224,0,1,0,7.224,7.224A7.232,7.232,0,0,0,345.441,171.912Zm0,10.543a3.319,3.319,0,1,1,3.319-3.319A3.323,3.323,0,0,1,345.44,182.455Z"
                                                  transform="translate(-2022.587 1409.05)" fill="#94c023" />
                                            <path id="Path_27" data-name="Path 27"
                                                  d="M95.38,0a1.952,1.952,0,0,0-1.952,1.952V6.118a1.952,1.952,0,0,0,3.9,0V1.952A1.952,1.952,0,0,0,95.38,0Z"
                                                  transform="translate(-1803.375 1563)" fill="#94c023" />
                                            <path id="Path_28" data-name="Path 28"
                                                  d="M239.886,0a1.952,1.952,0,0,0-1.952,1.952V6.118a1.952,1.952,0,1,0,3.9,0V1.952A1.952,1.952,0,0,0,239.886,0Z"
                                                  transform="translate(-1932.783 1563)" fill="#94c023" />
                                            <rect id="doctor-mask" width="56" height="56"
                                                  transform="translate(-1721 1562)" fill="none" />
                                        </g>
                                    </svg>
                                </div>
                                <div class="feature__number en color">
                                    +400
                                </div>
                                <div class="feature__text">
                                    <h6>
                                        طبيب
                                    </h6>
                                </div>
                            </div>
                        </div>
                        <!-- // feature -->
                        <!-- feature -->
                        <div class="col-lg-4" data-aos="fade-up" data-aos-delay="100" data-aos-duration="600">
                            <div class="feature">
                                <div class="feature__icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="56" height="56" viewBox="0 0 56 56">
                                        <g id="branch" transform="translate(1721 -1562)">
                                            <rect id="branch-mask" width="56" height="56"
                                                  transform="translate(-1721 1562)" fill="none" />
                                            <path id="Path_22" data-name="Path 22"
                                                  d="M202.41,139.014A6.41,6.41,0,1,0,196,132.6,6.417,6.417,0,0,0,202.41,139.014Zm0-9.614a3.2,3.2,0,1,1-3.205,3.2A3.208,3.208,0,0,1,202.41,129.4Z"
                                                  transform="translate(-1895.41 1449.938)" fill="#94c023" />
                                            <path id="Path_23" data-name="Path 23"
                                                  d="M56.922,36.855H46.2c5.008-4.78,9.564-9.465,9.564-17.626A18.781,18.781,0,0,0,36.533,0,18.783,18.783,0,0,0,17.3,19.229c0,8.161,4.557,12.846,9.564,17.626H16.144L10.284,54.7h52.5ZM20.509,19.229C20.509,9.944,27.248,3.2,36.533,3.2S52.557,9.944,52.557,19.229c0,10.388-8.768,14.067-16.024,23.013a74.29,74.29,0,0,0-6.78-7.065C24.588,30.263,20.509,26.381,20.509,19.229Zm-4.5,28.309H27.56v-3.2h-10.5l1.4-4.273H30.124v-.072a50.81,50.81,0,0,1,6.41,7.6,50.63,50.63,0,0,1,6.409-7.6v.072H54.6l1.4,4.273h-10.5v3.2H57.058l1.3,3.953H14.71Z"
                                                  transform="translate(-1729.533 1562.652)" fill="#94c023" />
                                        </g>
                                    </svg>
                                </div>
                                <div class="feature__number en color">
                                    +20
                                </div>
                                <div class="feature__text">
                                    <h6>
                                        فرع
                                    </h6>
                                </div>
                            </div>
                        </div>
                        <!-- // feature -->
                        <!-- feature -->
                        <div class="col-lg-4" data-aos="fade-up" data-aos-delay="200" data-aos-duration="600">
                            <div class="feature">
                                <div class="feature__icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="56" height="56" viewBox="0 0 56 56">
                                        <g id="client" transform="translate(1721 -1562)">
                                            <rect id="client-mask" width="56" height="56"
                                                  transform="translate(-1721 1562)" fill="none" />
                                            <path id="Path_20" data-name="Path 20"
                                                  d="M51.081,11.54a11.54,11.54,0,1,0-11.54,11.54,11.54,11.54,0,0,0,11.54-11.54ZM39.54,18.465a6.924,6.924,0,1,1,6.924-6.924,6.924,6.924,0,0,1-6.924,6.924Z"
                                                  transform="translate(-1737.449 1562.617)" fill="#94c023" />
                                            <path id="Path_21" data-name="Path 21"
                                                  d="M58.885,50.855a7.963,7.963,0,0,0-6.572-1.676V46.924A6.932,6.932,0,0,0,45.389,40H26.924A6.932,6.932,0,0,0,20,46.924V65.389A2.308,2.308,0,0,0,22.308,67.7H39.623a50.952,50.952,0,0,0,7.036,4.369,2.4,2.4,0,0,0,2.077,0C49.753,71.553,58.752,66.9,61.3,61.805A9.484,9.484,0,0,0,58.885,50.855ZM24.616,46.924a2.308,2.308,0,0,1,2.308-2.308H45.389A2.308,2.308,0,0,1,47.7,46.924v4.124c-5.856-3.666-9.729-1.411-11.188-.193a9.485,9.485,0,0,0-2.417,10.95,9.858,9.858,0,0,0,.776,1.276H24.616ZM57.173,59.74C55.9,62.279,51.067,65.549,47.7,67.4c-3.369-1.844-8.2-5.109-9.475-7.656A4.842,4.842,0,0,1,39.466,54.4a3.149,3.149,0,0,1,2.077-.731,8.882,8.882,0,0,1,4.769,2.026,2.308,2.308,0,0,0,2.77,0c1.651-1.239,4.737-3.058,6.846-1.3a4.842,4.842,0,0,1,1.245,5.341Z"
                                                  transform="translate(-1734.065 1545.698)" fill="#94c023" />
                                            <circle id="Ellipse_8" data-name="Ellipse 8" cx="2.5" cy="2.5" r="2.5"
                                                    transform="translate(-1684.065 1601.617)" fill="#94c023" />
                                        </g>
                                    </svg>
                                </div>
                                <div class="feature__number en color">
                                    +1 M
                                </div>
                                <div class="feature__text">
                                    <h6>
                                        عميل
                                    </h6>
                                </div>
                            </div>
                        </div>
                        <!-- // feature -->

                        <!-- feature text -->
                        <div class="col-lg-12">
                            <div class="feature__p">
                                <hr>
                                <p>
                                    ١٥ ﻋﺎﻣﺎ ﻣﻦ اﻟﺮﻳﺎدة ﻓﻰ اﻟﺮﻋﺎﻳﺔ اﻟﺼﺤﻴﺔ <br>
                                    ﻧﺨﺪم أﻛﺜﺮ ﻣﻦ ﻣﻠﻴﻮن ﻋﻤﻴﻞ ﺑﺄﺣﺪث اﻟﺘﻘﻨﻴﺎت اﻟﻌﺎﻟﻤﻴﺔ <br>
                                    ﺣﺎﺻﻠﻮن ﻋﻠﻰ JCIA ﻓﻰ ﺗﻄﺒﻴﻖ أﻋﻠﻰ ﻣﻌﺎﻳﻴﺮ اﻟﺠﻮدة وﺳﻼﻣﺔ اﻟﻤﺮﺿﻰ <br>
                                    رﺿﺎء ﻋﻤﻼﺋﻨﺎ.. ﻫﻮ ﻣﺎﻧﺴﻌﻰ إﻟﻴﻪ داﺋﻤﺎ!
                                </p>
                                <hr>
                            </div>
                        </div>
                        <!-- // feature text -->

                    </div>
                </div>
                <div class="col-lg-2"></div>
            </div>
        </div>
    </div>
    <!-- // features -->


    <!-- services -->
    <div class="services" id="services">
        <div class="container">
            <div class="row">
                <!-- title -->
                <div class="col-6" data-aos="fade-down" data-aos-duration="600">
                    <h2 class="title">
                        خدماتنا
                    </h2>
                </div>
                <div class="col-6 text-left" data-aos="fade-down" data-aos-duration="600">
                    <a href="#book" class="btn btn-brown">{{ trans_choice('messages.choosenow', $page->gender) }}</a>
                </div>
                <!-- // title -->
            </div>
        </div>
        <!-- services slider -->
        <div class="services__slider">
            <div class="container">
                <div class="owl-carousel" id="services-slider">

                    @foreach($services as $service)
                        <div class="services__slider-block">
                            <h6>
                                {!! $service->name !!}
                            </h6>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <!-- // services slider -->
    </div>
    <!-- // services -->


    <!-- offers -->
    <div class="offers d-pad" id="offers">
        <div class="container">
            <!-- title -->
            <h2 class="title" data-aos="fade-down" data-aos-duration="600">
                العروض
            </h2>
            <!-- // title -->

            <div class="row">
                @foreach($offers as $offer)
                    <div class="col-md-6 col-lg-4 d-flex align-items-stretch">
                        <div class="offer">
                            <div class="offer__photo">
                                <img src="{{ $offer->image }}" alt="{{ $offer->name }}" draggable="false">
                            </div>
                            <div class="offer__info">
                                <h5>{{ $offer->name }}</h5>
                                <p>
                                    <span class="color en">{{ $offer->price }}</span>
                                </p>
                                <a class="cta" href="#book">
                                    {{ trans_choice('messages.choosenow', $page->gender) }}
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <!-- more -->
        <div class="more-offers text-center">
            <button class="btn more-btn">
                المزيد<br>
                <img src="{{latest('/web/assets/images/more.svg')}}" alt="المزيد" draggable="false" class="d-inline-block">
            </button>
        </div>
        <!-- // more -->
    </div>
    <!-- // offers -->


    <!-- testimonial -->
    <div class="testimonials" id="reviews">
        <div class="container">
            <!-- title -->
            <h2 class="title" data-aos="fade-down" data-aos-duration="600">
                آراء عملائنا
            </h2>
            <!-- // title -->
            <div class="row">
                <!-- testimonials slider -->
                <div class="col-12">
                    <div class="owl-carousel testimonial" id="testimonials">
                        {!! settings()->get('common.testimonials') !!}
                    </div>
                </div>
                <!-- // testimonials slider -->
            </div>
        </div>
    </div>
    <!-- // testimonial -->


    <!-- book -->
    <div class="book text-center" id="book">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 offset-lg-3">
                    <!-- book -->
                    <div class="main__book" data-aos="zoom-in-up" data-aos-duration="600">
                        <div class="book-block text-center">
                            @if($page->discount_url)
                                <a  class="book-block__title d-block" href="{{ $page->discount_url }}" style="font-size: 17.5px">
                                    @else
                                        <div  class="book-block__title d-block" style="cursor: default; font-size: 17.5px">
                                            @endif
                                            {{ $page->discount_text }}
                                            @if($page->discount_percent)
                                                <span class="en">
                                        {{ $page->discount_percent }}
                                    </span>
                                    @endif
                                    @if($page->discount_url)
                                </a>
                            @else
                        </div>
                        @endif
                        <div class="book-block__form">
                            @include('Page.Resources.views.ram.form')
                        </div>
                    </div>
                </div>                 <!-- // book -->
            </div>
        </div>
    </div>

    <footer>
        <div class="container">
            <div class="row">
                <div class="col-5 text-right">
                    <p>
                        جميع الحقوق محفوظة
                    </p>
                </div>
                <div class="col-2 text-center">
                    <img src="{{latest('/web/assets/images/logo.svg')}}" alt="عيادات رام" draggable="false" class="img-fluid">
                </div>
                <div class="col-5 text-left">
                    <p>
                        عيادات رام 2021
                    </p>
                </div>
            </div>
        </div>
    </footer>
@endsection
@section('submit.scripts')
    {!! settings()->get('pages.body.scripts') !!}

    <script type='text/javascript'>
        var form = $('.form');
        $('.form').submit(function(e) {
            e.preventDefault();
            $.ajax({
                type: $( this ).attr('method'),
                url: $( this ).attr('action'),
                data: $( this ).serialize(),
                success: function (data) {
                    window.location.href = route('web.pages.thanks');
                },
                error: function (data) {
                    window.location.href = route('web.pages.thanks');
                }
            });

        });
    </script>
@endsection

