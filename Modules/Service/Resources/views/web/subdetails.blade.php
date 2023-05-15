@extends('web.layouts.base')

@section('styles')
    <link rel="stylesheet preload" href="{{latest('/web/assets2/css/services'.( (app()->getLocale() == 'ar') ? '-rtl' : '').'.min.css')}}" as="style" crossorigin>

@endsection

@section('pageTitle')
    {{ $sub_service->meta_title ? $sub_service->meta_title : $sub_service->name }}
@endsection

@section('metaKeys')
    <meta property="og:title" content="{{ $sub_service->name ?? '' }}"/>
    <meta property="og:description" content="{{ $sub_service->meta_description ?? '' }}" />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="{{ url()->current() ?? '' }}"/>
    <meta property="og:image" content="{{ $sub_service->image ?? '/web/assets/images/logo.svg' }}"/>

    <!-- Meta description for twitter. -->
    <meta name="twitter:card" content="{{ $sub_service->image ?? '/web/assets/images/logo.svg' }}">
    <meta name="twitter:site" content="{{ url('/') }}">
    <meta name="twitter:title" content="{{ $sub_service->name ?? '' }}"/>
    <meta name="twitter:description" content="{{ $sub_service->meta_description ?? '' }}" />
    <meta name="twitter:image" content="{{ $sub_service->image ?? '/web/assets/images/logo.svg' }}" />

    <meta name="title" content="{{ $sub_service->meta_title ? $sub_service->meta_title : '' }}" />
    <meta name="description" content="{{ $sub_service->meta_description ? $sub_service->meta_description : '' }}" />
    <meta name="keywords" content="{{ $sub_service->meta_keywords  ? $sub_service->meta_keywords : ''}}" />
    <link rel="canonical" href="{{ $sub_service->canonical_url ? $sub_service->canonical_url : '' }}" />
@endsection

@section('slug')
    @if(app()->getLocale() == 'ar')
        <li class="list-inline-item d-none d-xl-inline-block">
            <a href="{{ route('web.subservices.details', ['slug' => $sub_service->translate('en')->slug , 'lang' => 'en']) }}" class="lang">
                English
            </a>
        </li>
    @else
        <li class="list-inline-item d-none d-xl-inline-block">
            <a href="{{ route('web.subservices.details', ['slug' => $sub_service->translate('ar')->slug ]) }}" class="lang">
                عربي
            </a>
        </li>
    @endif
@endsection

@section('lang-mobile')
    @if(app()->getLocale() == 'ar')
        <a href="{{ route('web.subservices.details', ['slug' => $sub_service->translate('en')->slug , 'lang' => 'en']) }}" class="d-xl-none lang">English</a>
    @else
        <a href="{{ route('web.subservices.details', ['slug' => $sub_service->translate('ar')->slug ]) }}" class="d-xl-none lang">عربي</a>
    @endif
@endsection

@section('content')
    <!-- page header -->
    <div class="page-header">
        <div class="container">
            <!-- image -->
            <div class="page-header__image">
                <picture>
                    <source srcset="{{ $sub_service->image ?? latest('/web/assets/images/page-header.webp') }}" type="image/webp" />
                    <img src="{{ $sub_service->image ?? latest('/web/assets/images/page-header.webp') }}" draggable="false" alt="{{ $sub_service->alt_brief_image ? $sub_service->alt_brief_image : '' }}" data-aos="zoom-out" />
                </picture>
            </div>
            <!-- // image -->
            <!-- title -->
            <h1 class="h3" data-aos="fade-up" data-aos-delay="100">
                {{ __('messages.Ram Services') }} {{ $sub_service->name ? $sub_service->name : '' }}
            </h1>
            <!-- title -->
        </div>
    </div>
    <!-- // page header -->


    <!-- services details -->
    <section class="services-details d-pad">
        <div class="container">
            <div class="services-slider">
                <div class="service__content">
                    <div class="row">
                        <!-- text -->
                        <div class="service__content-text col-12">
                            <h3 data-aos="fade-up">{{ $sub_service->name ?? '' }}</h3>
                        </div>
                        <div class="col-lg-6 col-xl-7">
                            <div class="service__content-text">
                                {!! $sub_service->description ?? '' !!}
                            </div>
                        </div>
                        <!-- // text -->
                        <!-- image -->
                        <div class="col-lg-6 col-xl-5">
                            <div class="service__content-image">
                                <picture>
                                    <source srcset="{{ $sub_service->icon ? $sub_service->icon : '' }}" type="image/webp"><img
                                        src="{{ $sub_service->icon ? $sub_service->icon : '' }}" draggable="false" loading="lazy" alt="{{ $sub_service->alt_image ? $sub_service->alt_image : '' }}"
                                        data-aos="zoom-out">
                                </picture>
                            </div>
                        </div>
                        <!-- // image -->
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- // services details -->

    <!-- book now -->
    <div class="article__block article__add-comment d-pad pt-0" data-aos="fade-up">
        <div class="container">
            <form method="POST" class="article__form sub_service_book_form" action="{{ route('web.booking.store', app()->getLocale() == 'en' ? ['lang' => 'en'] : '') }}">
                @csrf
                <div class="title-container sub_service_book_form_title" data-aos="fade-up">
                    <span class="btn btn-brand-link">
                        {{ (app()->getLocale() == 'ar') ? 'أحجز موعدك الآن' : 'Book your appointment now' }}
                    </span>
                    <h2 class="title">
                            {{ (app()->getLocale() == 'ar') ? 'هل تريد الحصول على' : 'Do you want to get' }}

                        <span class="color">
                            {{ $sub_service->name ?? '' }}{{ (app()->getLocale() == 'ar') ? '؟' : '?' }}

                        </span>
                    </h2>
                </div>
                <input type="hidden" name="speciality" value="{{ $sub_service->id ?? '' }}" required>
                <div class="form-row sub_service_book_form_container">
                    <div class="form-group sub_service_book_form_group">
                        <label for="commentName" class="sr-only">{{ __('messages.Full Name') }}</label>
                        <input type="text" class="form-control" id="bookName" placeholder="{{ __('messages.namerequired') }}" name="name" value="{{ old('name') }}" required>
                    </div>
                    <div class="form-group sub_service_book_form_group">
                        <input type="tel" class="form-control" onchange="validateContact(this)" maxlength="10" id="bookPhone"  placeholder="{{ __('messages.phonerequired') }} (05xxxxxxxx)." name="phone" value="{{ old('phone') }}" required>
                        <div class="invalid-feedback">
                            {{ (app()->getLocale() == 'ar') ? 'يجب أن يكون هذا الحقل جوالًا سعوديًا (05xxxxxxxx).' : 'This field must be saudi arabia mobile (05xxxxxxxx).'}}
                           </div>
                    </div>
                    <div class="form-group sub_service_book_form_group">
                        <input type="email" class="form-control" id="bookEmail" placeholder="{{ __('messages.emailrequired') }}" name="email" value="{{ old('email') }}" required>
                    </div>
                    <div class="form-group sub_service_book_form_group">
                        <input onchange="return checkAvailableAppointment();"  type="date" class="form-control" name="attendance_date" value="{{ old('attendance_date') }}" id="bookDate" required>
                    </div>
                    <div class="form-group sub_service_book_form_group">
                        <select class="custom-select" id="bookTime1" name="available_time" required>
                            <option value="">{{ __('messages.timerequired') }}</option>
                            <option value="{{ (app()->getLocale() == 'ar') ? 'صباحي' : 'Morning'}}">{{ (app()->getLocale() == 'ar') ? 'صباحي' : 'Morning'}}</option>
                            <option value="{{ (app()->getLocale() == 'ar') ? 'مسائي' : 'Evening'}}">{{ (app()->getLocale() == 'ar') ? 'مسائي' : 'Evening'}}</option>
                        </select>
                    </div>
                    <div class="form-group sub_service_book_form_group">
                        <select class="custom-select" id="bookDoctor" name="doctor_id" required>
                            <option value="">{{ __('messages.doctorrequired') }}</option>
                            @if(!empty($doctors))
                                @foreach($doctors as $doctor)
                                <option value="{{ $doctor->id }}" data-branchdr="{{ $doctor->branches }}" {{  old('doctor_id') == $doctor->id ? 'selected' : '' }}>{{ $doctor->name }}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                    <div class="form-group sub_service_book_form_group">
                        <select class="custom-select" id="bookBranch" name="branche_id" required>
                            <option value="">{{ __('messages.brancherequired') }}</option>
                        </select>
                    </div>
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-brand-primary btn-form Booking_ads" data-aos="fade-up">
                            {{ __('messages.Book Your Appointment Now') }}
                            <svg class="btn-icon">
                                <use href="{{latest('/web/assets/images/icons/icons.svg#book')}}"></use>
                            </svg>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- // book now -->


    <!-- services slider -->
    <div class="services-slider">
        <div class="container">
            <div data-aos="fade-up">
                <div class="title-container" data-aos="fade-up">
                    <h2 class="title">
                    {{ __('messages.similar_service') }} <span class="color">{{ __('messages.similar') }}</span>
                    </h2>
                </div>
                <div class="swiper servicesSlider">
                    <div class="swiper-wrapper">
                        <!-- service slide -->
                        @foreach($relatedSubservices as $key => $subservice)
                        <div class="swiper-slide">
                            <a @if($subservice->slug) href="{{ route('web.subservices.details', app()->getLocale() == 'en' ? ['slug' => $subservice->slug , 'lang' => 'en'] : ['slug' => $subservice->slug ]) }}" @endif>
                                <!-- image -->
                                <div class="service__image" data-aos="zoom-out">
                                    <picture>
                                        <source srcset="{{ $subservice->icon ? $subservice->icon : '' }}" type="image/webp" />
                                        <img src="{{ $subservice->icon ? $subservice->icon : '' }}" draggable="false" loading="lazy" alt="{{ $subservice->alt_image ? $subservice->alt_image : '' }}" />
                                    </picture>
                                </div>
                                <!-- // image -->
                                <!-- title -->
                                <div class="service__title d-block text-center" data-aos="zoom-in-up" data-aos-delay="200">
                                    <h2 class="h6">{{ $subservice->name ? $subservice->name : '' }}</h2>
                                </div>
                                <!-- // title -->
                            </a>
                        </div>
                        @endforeach
                    </div>
                    <div class="slider-control">
                        <div class="swiper-button-next service-next"></div>
                        <div class="swiper-button-prev service-prev"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- // services slider -->


    <!-- doctors -->
    @if(count($servicedoctors) > 0)
        <section class="doctors d-pad">
            <div class="container">
                <!-- title -->
                <div class="title-container" data-aos="fade-up">
                    <h2 class="title">
                        {{ __('messages.Ram Doctors') }} <span class="color">{{ $sub_service->service->name ? $sub_service->service->name : '' }}</span>
                    </h2>
                    <a href="{{ route('web.doctors.index', app()->getLocale() == 'en' ? ['services' => $sub_service->id , 'lang' => 'en'] : ['services' => $sub_service->id ]) }}" class="btn btn-brand-link">
                        {{ __('messages.all doctors') }} {{ $sub_service->service->name ? $sub_service->service->name : '' }}
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
                                <a href="{{ url($article->category->slug) . ( app()->getLocale() != 'ar' ? '?lang=en' : '' ) }}" class="overline">
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
<script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.9/jquery.validate.js"></script>
<script language="javascript">
    $(document).ready(function(){
        var today = new Date();
        var dd = String(today.getDate()).padStart(2, '0');
        var mm = String(today.getMonth() + 1).padStart(2, '0');
        var yyyy = today.getFullYear();

        today = yyyy + '-' + mm + '-' + dd;

        $('#bookDate').attr('min',today).attr('value',today);
   });
</script>
<script type='text/javascript'>


    function checkAvailableAppointment() {
        doctorId = $("#bookDoctor option:selected").val();
        brancheId = $("#bookBranch option:selected").val();
        date = $("#bookDate").val();
        time = $("#bookTime option:selected").val();

        if (doctorId) {
            $.ajax({
                type: 'GET',
                url: route('web.booking.check.availability', {
                    'doctor_id': doctorId,
                    'attendance_date': date,
                    'available_time': time,
                    'branche_id': brancheId
                }),
                processData: false,
                contentType: false,
                success: function (data) {
                    // console.log(data);
                    if (data == '0') {
                        $("#availability_alert").css('display', 'block');
                    } else {
                        $("#availability_alert").css('display', 'none');
                    }
                },
                error: function (data) {
                }
            });
        }
    }

    function validateContact(tel) {

    var xyz=document.getElementById('bookPhone').value.trim();

    var  phoneno = /^\d{10}$/;
    if((tel.value.match(phoneno)) && tel.value.length == 10 && xyz.substr(0,2)==='05' && $.isNumeric(xyz))
        {
            $(tel).removeClass('is-invalid');
            $(tel).addClass('is-valid');
        }
    else
        {
            $("#bookPhone").val('');
            $(tel).removeClass('is-valid');
            $(tel).addClass('is-invalid');
        }
    }

</script>

<script>
    $(document).ready(function () {
        let branches = $('#bookDoctor').find(':selected').data('branchdr');

        if( branches != undefined ){
            $.each(branches, function (index, value){
                $('#bookBranch').append('<option value="'+ value.id +'">'+ value.name +'</option>');
            });
        }
    })

    $(document).on('click', '#bookDoctor', function () {
        let branches = $('#bookDoctor').find(':selected').data('branchdr');

        $('#bookBranch').empty();

        $('#bookBranch').append('<option value="">{{ __('messages.brancherequired') }}</option>');
        $.each(branches, function (index, value){
            $('#bookBranch').append('<option value="'+ value.id +'">'+ value.name +'</option>');
        });
    })
</script>
@stop
