@extends('Page.Resources.views.bh.base')
@section('scripts')
    {!!  settings()->get('pages.bh.scripts') !!}
@endsection
@section('content')

    <!-- header -->
    <header class="header" data-aos="fade-down">
        <div class="container">
            <div class="row">
                <!-- logo -->
                <div class="col">
                    <div class="header__logo">
                        <picture><source srcset="{{latest('/web/bh/assets/images/icons/icons.svg#logo')}}" type="image/webp"><img src="{{latest('web/bh/assets/images/icons/icons.svg#logo')}}" alt="Logo" draggable="false"></picture>
                        <span>فرع البحرين</span>
                    </div>
                </div>
                <!-- // logo -->
                <!-- right side -->
                <div class="col text-left">
                    <!-- location -->
                    <div class="icon-block">
                        <div class="icon-block__text">
                            <a
                                    href="https://www.google.com.sa/maps/place/+++/@26.2006819,50.5604014,17z/data=!3m1!4b1!4m9!1m3!11m2!2s1Da7endcwNaUpKC-9o4_D0X9acYU!3e3!3m4!1s0x3e49af0892760a5d:0xc2ec98cf5684cd6!8m2!3d26.2006819!4d50.5582127?hl=ar&shorturl=1">
                                البحرين - المنامة
                            </a>
                        </div>
                        <div class="icon-block__icon">
                            <a href="https://www.google.com.sa/maps/place/+++/@26.2006819,50.5604014,17z/data=!3m1!4b1!4m9!1m3!11m2!2s1Da7endcwNaUpKC-9o4_D0X9acYU!3e3!3m4!1s0x3e49af0892760a5d:0xc2ec98cf5684cd6!8m2!3d26.2006819!4d50.5582127?hl=ar&shorturl=1">
                                <picture><source srcset="{{latest('web/bh/assets/images/icons/icons.svg#location')}}" type="image/webp"><img class="icon" src="{{latest('web/bh/assets/images/icons/icons.svg#location')}}" alt="Logo"></picture>
                            </a>
                        </div>
                    </div>
                    <!-- // location -->
                    <!-- phone -->
                    <div class="icon-block">
                        <div class="icon-block__text">
                            <a href="tel:17422022">17422022</a>
                        </div>
                        <div class="icon-block__icon">
                            <a href="tel:17422022">
                                <picture><source srcset="{{latest('/web/bh/assets/images/icons/icons.svg#phone')}}" type="image/webp"><img class="icon" src="{{latest('web/bh/assets/images/icons/icons.svg#phone')}}" alt="Logo"></picture>
                            </a>
                        </div>
                    </div>
                    <!-- // phone -->
                    <a href="#book" class="btn btn-white">احجز الآن</a>
                </div>
                <!-- // right side -->
            </div>
        </div>
    </header>
    <!-- // header -->

    <!-- hero -->
    <div class="hero d-flex align-items-center">
        <div class="container">
            <!-- hero text -->
            <div class="hero__text text-center">
                {!!  $page->description !!}
            </div>
            <!-- // hero text -->
        </div>
    </div>
    <!-- // hero -->

    <!-- about -->
    <section class="about">
        <div class="container">
            <div class="about__container">
                <div class="about__image">
                    <picture><source srcset="{{ $page->image }}" type="image/webp"><img src="{{ $page->image }}" alt="أنت في ايد امنة"></picture>
                </div>
                <div class="about__text">
                    <h2 data-aos="fade-up">
                        أنت في ايد امنة
                        <span class="color" data-aos="fade-up" data-aos-delay="200">
                            الجودة ، السلامة ، رضا العملاء ، وأخيراً المصداقية
                        </span>
                    </h2>
                    <p data-aos="fade-up" data-aos-delay="400">
                        نحن في عيادات رام نتخصص في الرعاية الطبية ونوفر خدمات ذات جودة عالية تحت سقف واحد بأحدث التقنيات
                        المتقدمة في جميع التخصصات
                    </p>
                </div>
            </div>

        </div>
    </section>
    <!-- // about -->


    <!-- services -->
    <section class="services text-center">
        <div class="container">
            <h2 class="title" data-aos="fade-up">
                    خدمات عيادات رام
            </h2>
            <!-- slider -->
            <div class="owl-carousel" id="services-slider">
                <!-- service -->
                <!-- // service -->
                @foreach($services as $service)
                    <div class="service">
                        <h6 class="service__name">
                            {!! $service->name !!}
                        </h6>
                    </div>

                @endforeach

            </div>
            <!-- // slider -->
        </div>
    </section>
    <!-- // services -->


    <!-- offers -->
    <section class="offers text-center" id="offers">
        <div class="container">
            <h2 class="title" data-aos="fade-up">
                عروض شهر فبراير
            </h2>
            <div class="row d-flex justify-content-center">

                @foreach($offers as $offer)
                    <div class="col-md-6 col-xl-4">
                        <div class="offer" data-aos="fade-up">
                            <div class="offer__photo">
                                <picture><source srcset="{{ $offer->image }}" type="image/webp"><img src="{{ $offer->image }}" alt="{{ $offer->name }}"  draggable="false"></picture>
                            </div>
                            <div class="offer__info">
                                <h6>
                                    {!!  $offer->description !!}

                                </h6>
                                <a href="#book" class="btn btn-dark-gradient d-block">{{ trans_choice('messages.choosenow', $page->gender) }}</a>
                            </div>
                            <div class="offer__price">
                            <span>
                                {{ $offer->price }}
                            </span>
                                <small>
                                    دينار
                                </small>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- // offers -->


    <!-- book -->
    <section class="book text-center" id="book">
        <div class="container">
            <div class="row">
                <div class="col-lg-7">
                    <div class="book__image">
                        <picture><source srcset="{{ $page->footer_image }}" type="image/webp"><img src="{{ $page->footer_image }}" alt="{{ trans_choice('messages.choosenow', $page->gender) }}" draggable="false"></picture>
                    </div>
                </div>
                <div class="col-lg-5">
                    <!-- book form -->
                    <div class="form-container">
                        <div class="book__form">
                            <!-- form -->
                            <h2 class="title" data-aos="fade-up">
                                {{ trans_choice('messages.choosenow', $page->gender) }}
                            </h2>
                            @include('Page.Resources.views.bh.form')
                        </div>
                    </div>
                    <!-- // book form -->
                </div>
            </div>
        </div>
    </section>
    <!-- // book -->

    <!-- partners -->
    <div class="partners text-center">
        <div class="container">
            <div class="partners-logos">
                <!-- partner-logo -->
                <div class="partner-logo">
                    <picture><source srcset="{{latest('web/bh/assets/images/partners/01.webp')}}" type="image/webp"><img src="{{latest('web/bh/assets/images/partners/01.png')}}" alt="Logo" draggable="false"></picture>
                </div>
                <!-- // partner-logo -->
                <!-- partner-logo -->
                <div class="partner-logo">
                    <picture><source srcset="{{latest('web/bh/assets/images/partners/02.webp')}}" type="image/webp"><img src="{{latest('web/bh/assets/images/partners/02.png')}}" alt="Logo" draggable="false"></picture>
                </div>
                <!-- // partner-logo -->
                <!-- partner-logo -->
                <div class="partner-logo">
                    <picture><source srcset="{{latest('web/bh/assets/images/partners/03.webp')}}" type="image/webp"><img src="{{latest('web/bh/assets/images/partners/03.png')}}" alt="Logo" draggable="false"></picture>
                </div>
                <!-- // partner-logo -->
                <!-- partner-logo -->
                <div class="partner-logo">
                    <picture><source srcset="{{latest('web/bh/assets/images/partners/04.webp')}}" type="image/webp"><img src="{{latest('web/bh/assets/images/partners/04.png')}}" alt="Logo" draggable="false"></picture>
                </div>
                <!-- // partner-logo -->
                <!-- partner-logo -->
                <div class="partner-logo">
                    <picture><source srcset="{{latest('web/bh/assets/images/partners/05.webp')}}" type="image/webp"><img src="{{latest('web/bh/assets/images/partners/05.png')}}" alt="Logo" draggable="false"></picture>
                </div>
                <!-- // partner-logo -->
                <!-- partner-logo -->
                <div class="partner-logo">
                    <picture><source srcset="{{latest('web/bh/assets/images/partners/06.webp')}}" type="image/webp"><img src="{{latest('web/bh/assets/images/partners/06.png')}}" alt="Logo" draggable="false"></picture>
                </div>
                <!-- // partner-logo -->
                <!-- partner-logo -->
                <div class="partner-logo">
                    <picture><source srcset="{{latest('web/bh/assets/images/partners/07.webp')}}" type="image/webp"><img src="{{latest('web/bh/assets/images/partners/07.png')}}" alt="Logo" draggable="false"></picture>
                </div>
                <!-- // partner-logo -->
                <!-- partner-logo -->
                <div class="partner-logo">
                    <picture><source srcset="{{latest('web/bh/assets/images/partners/08.webp')}}" type="image/webp"><img src="{{latest('web/bh/assets/images/partners/08.png')}}" alt="Logo" draggable="false"></picture>
                </div>
                <!-- // partner-logo -->
                <!-- partner-logo -->
                <div class="partner-logo">
                    <picture><source srcset="{{latest('web/bh/assets/images/partners/09.webp')}}" type="image/webp"><img src="{{latest('web/bh/assets/images/partners/09.png')}}" alt="Logo" draggable="false"></picture>
                </div>
                <!-- // partner-logo -->
                <!-- partner-logo -->
                <div class="partner-logo">
                    <picture><source srcset="{{latest('web/bh/assets/images/partners/10.webp')}}" type="image/webp"><img src="{{latest('web/bh/assets/images/partners/10.png')}}" alt="Logo" draggable="false"></picture>
                </div>
                <!-- // partner-logo -->

            </div>
        </div>
    </div>
    <!-- // partners -->

    <!-- contact -->
    <div class="contact">
        <!-- map -->
        <div class="contact__map">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3579.875631454306!2d50.56024878446015!3d26.200723696682644!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3e49af0892760a5d%3A0xc2ec98cf5684cd6!2z2YXYsdmD2LIg2LnZitin2K_Yp9iqINix2KfZhSDYp9mE2LfYqNmK2Kk!5e0!3m2!1sar!2seg!4v1614601385300!5m2!1sar!2seg" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
        </div>
        <!-- map -->
        <!-- header -->
        <div class="container">
            <div class="contact__header">
                <div class="header" data-aos="fade-up">
                    <div class="row">
                        <!-- logo -->
                        <div class="col">
                            <div class="header__logo">
                                <picture><source srcset="{{latest('assets/images/icons/icons.svg#logo')}}" type="image/webp"><img src="{{latest('assets/images/icons/icons.svg#logo')}}" alt="Logo" draggable="false"></picture>
                            </div>
                        </div>
                        <!-- // logo -->
                        <!-- right side -->
                        <div class="col text-left">
                            <!-- location -->
                            <div class="icon-block">
                                <div class="icon-block__text">
                                    <a
                                            href="https://www.google.com.sa/maps/place/+++/@26.2006819,50.5604014,17z/data=!3m1!4b1!4m9!1m3!11m2!2s1Da7endcwNaUpKC-9o4_D0X9acYU!3e3!3m4!1s0x3e49af0892760a5d:0xc2ec98cf5684cd6!8m2!3d26.2006819!4d50.5582127?hl=ar&shorturl=1">
                                        البحرين - المنامة
                                    </a>
                                </div>
                                <div class="icon-block__icon">
                                    <a href="https://www.google.com.sa/maps/place/+++/@26.2006819,50.5604014,17z/data=!3m1!4b1!4m9!1m3!11m2!2s1Da7endcwNaUpKC-9o4_D0X9acYU!3e3!3m4!1s0x3e49af0892760a5d:0xc2ec98cf5684cd6!8m2!3d26.2006819!4d50.5582127?hl=ar&shorturl=1">
                                        <picture><source srcset="{{latest('assets/images/icons/icons.svg#location')}}" type="image/webp"><img class="icon" src="{{latest('assets/images/icons/icons.svg#location')}}" alt="Logo"></picture>
                                    </a>
                                </div>
                            </div>
                            <!-- // location -->
                            <!-- phone -->
                            <div class="icon-block">
                                <div class="icon-block__text">
                                    <a href="tel:17422022">17422022</a>
                                </div>
                                <div class="icon-block__icon">
                                    <a href="tel:17422022">
                                        <picture><source srcset="{{latest('assets/images/icons/icons.svg#phone')}}" type="image/webp"><img class="icon" src="{{latest('assets/images/icons/icons.svg#phone')}}" alt="Logo"></picture>
                                    </a>
                                </div>
                            </div>
                            <!-- // phone -->
                        </div>
                        <!-- // right side -->
                    </div>
                </div>
            </div>
        </div>
        <!-- // header -->
    </div>
    <!-- // contact -->

    <!-- foooter -->
    <footer class="footer text-center">
        <div class="container">
            <div class="small">
                جميع الحقوق محفوظة &copy; عيادات رام - فرع البحرين
            </div>
        </div>
    </footer>
    <!-- // foooter -->

@endsection
@section('submit.scripts')
    {!! settings()->get('pages.bh.body.scripts') !!}

    <script type='text/javascript'>

        // book message
        $("#book-msg-toggle").click(function () {
            $(".book-now").slideUp("slow");
            $(".book-msg").slideDown("slow");
        });

        var form = $('.form');
        $('.form').submit(function(e) {
            e.preventDefault();
            $.ajax({
                type: $( this ).attr('method'),
                url: $( this ).attr('action'),
                data: $( this ).serialize(),
                success: function (data) {
                    window.location.href = route('web.bh.pages.thanks');
                },
                error: function (data) {
                    window.location.href = route('web.bh.pages.thanks');
                }
            });

        });
    </script>
@endsection

