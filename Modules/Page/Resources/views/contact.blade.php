@extends('web.layouts.base')

@section('styles')
    <link rel="stylesheet" href="/web/assets2/css/contact{{ (app()->getLocale() == 'ar') ? '-rtl' : ''}}.min.css" crossorigin="anonymous">
@endsection

@section('pageTitle', $settings['metatitle.contact'][app()->getLocale()] ?? __('messages.Contact'))

@section('metaKeys')
    {!! $settings['contact_us.seo'][app()->getLocale()] ?? '' !!}
@endsection

@section('slug')
    <li class="list-inline-item d-none d-xl-inline-block">
        <a href="{{ url(app()->getLocale() != 'ar' ? 'contact-us' : 'contact-us?lang=en') }}" class="lang">
            {{ app()->getLocale() != 'ar' ? __('messages.ar') : __('messages.en') }}
        </a>
    </li>
@endsection

@section('lang-mobile')
    <a href="{{ url(app()->getLocale() != 'ar' ? 'contact-us' : 'contact-us?lang=en') }}" class="d-xl-none lang">
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
                    <source srcset="/web/assets/images/page-header.webp" type="image/webp">
                    <img src="/web/assets/images/page-header.jpg" draggable="false" alt="page image" data-aos="zoom-out">
                </picture>
            </div>
            <!-- // image -->
            <!-- title -->
            <h1 class="h3" data-aos="fade-up" data-aos-delay="100">
                {{ __("messages.Contact") }}
            </h1>
            <!-- title -->
        </div>
    </div>
    <!-- // page header -->


    <!-- contact -->
    <section class="contact d-pad">
        <div class="container">
            <!-- title -->
            <div class="section-title">
                {!! $settings['contact-us.titles'][app()->getLocale()] ?? '' !!}
            </div>

            <!-- Success Alert -->
            {{-- @if(session()->has('success'))
                <div class="row">
                    <div class="form-group col-md-7">
                        <div class="alert alert-success alert-dismissible fade show">
                            <strong style="margin: 8px;"> {{ (app()->getLocale() == 'ar') ? 'شكرا لك' : 'Thank You'}} </strong>  {{ (app()->getLocale() == 'ar') ? 'تم ارسال رسالتك بنجاح.' : 'Your message has been sent successfully.'}}
                            <button type="button" class="close ml-auto" data-dismiss="alert" aria-label="Close" @if(app()->getLocale() == 'ar') style="margin: -3px -23px 0px; float: left;" @else style="margin: -3px -23px 0px;" @endif>
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    </div>
                </div>
            @endif --}}

        <!-- // title -->
            <div class="contact__container">
                <!-- contact -->
                <div class="contact__form">
                    <h3 class="h5" data-aos="fade-up">{{ __("messages.Send") }}</h3>
                    <form class="form" method="POST" action="{{ route('web.pages.store', app()->getLocale() == 'en' ? ['lang' => 'en'] : '') }}">
                    @csrf
                    <!-- name -->
                        <div class="form-group row d-flex align-items-center" data-aos="fade-up">
                            <label for="contactName" class="col-lg-3 col-form-label">{{ __("messages.Full Name") }}</label>
                            <div class="col-lg-9">
                                <input type="text" class="form-control" id="contactName" name="name" placeholder="{{ __("messages.Full Name") }}">
                            </div>
                        </div>
                        <!-- // name -->
                        <!-- phone -->
                        <div class="form-group row d-flex align-items-center" data-aos="fade-up">
                            <label for="contactPhone" class="col-lg-3 col-form-label">{{ __("messages.Phone Number") }}</label>
                            <div class="col-lg-9">
                                <input type="tel" class="form-control" id="contactPhone" onchange="validateContact(this)" maxlength="10" name="phone" placeholder="{{ __("messages.Phone Number") }} (05xxxxxxxx).">
                                <div class="invalid-feedback">
                                    {{ (app()->getLocale() == 'ar') ? 'يجب أن يكون هذا الحقل جوالًا سعوديًا (05xxxxxxxx).' : 'This field must be saudi arabia mobile (05xxxxxxxx).'}}
                                </div>
                            </div>
                        </div>
                        <!-- // phone -->
                        <!-- email -->
                        <div class="form-group row d-flex align-items-center" data-aos="fade-up">
                            <label for="contactEmail" class="col-lg-3 col-form-label">{{ __("messages.Email Address") }}</label>
                            <div class="col-lg-9">
                                <input type="email" class="form-control" id="contactEmail" name="email" placeholder="{{ __("messages.Email Address") }}">
                            </div>
                        </div>
                        <!-- // email -->
                        <!-- message -->
                        <div class="form-group row" data-aos="fade-up">
                            <label for="contactMessage" class="col-lg-3 col-form-label">{{ __("messages.Message") }}</label>
                            <div class="col-lg-9">
                                <textarea class="form-control" placeholder="{{ (app()->getLocale() == 'ar') ? 'أدخل رسالتك' : 'Enter your message ..'}}" name="content" id="contactMessage"></textarea>
                            </div>
                        </div>
                        <!-- // message -->
                        <!-- btn -->
                        <div class="row d-flex align-items-center">
                            <div class="col-lg-3"></div>
                            <div class="col-lg-9">
                                <button class="btn btn-brand-primary btn-form" data-aos="fade-up" type="submit">
                                    {{ __("messages.Send") }}
                                </button>
                            </div>
                        </div>
                        <!-- btn -->
                    </form>
                </div>
                <!-- // contact -->
                <!-- info -->
                <div class="contact__info">
                    <h3 class="h5" data-aos="fade-up">{{ __("messages.Reach Us") }}</h3>
                    <!-- numbers and mail -->
                    <div class="contact__numbers">
                        <!-- number -->
                        <div class="contact__number" data-aos="fade-up">
                            <a href="tel:{{ $settings['common.phone'][app()->getLocale()] ?? '' }}">
                                <span class="contact__number-icon">
                                    <svg class="icon">
                                        <use href="/web/assets/images/icons/icons.svg#tel"></use>
                                    </svg>
                                </span>
                                <span class="contact__number-text">
                                    {{ $settings['common.phone'][app()->getLocale()] ?? '' }}
                                </span>
                            </a>
                        </div>
                        <!-- // number -->
                        <!-- number -->
                        <div class="contact__number" data-aos="fade-up">
                            <a href="tel:{{ $settings['common.phone.1'][app()->getLocale()] ?? '' }}">
                                <span class="contact__number-icon">
                                    <svg class="icon">
                                        <use href="/web/assets/images/icons/icons.svg#tel"></use>
                                    </svg>
                                </span>
                                <span class="contact__number-text">
                                    {{ $settings['common.phone.1'][app()->getLocale()] ?? '' }}
                                </span>
                            </a>
                        </div>
                        <!-- // number -->
                        <!-- number -->
                        <div class="contact__number" data-aos="fade-up">
                            <a href="mailto:{{ $settings['common.email'][app()->getLocale()] ?? '' }}">
                                <span class="contact__number-icon">
                                    <svg class="icon">
                                        <use href="/web/assets/images/icons/icons.svg#email"></use>
                                    </svg>
                                </span>
                                <span class="contact__number-text">
                                    {{ $settings['common.email'][app()->getLocale()] ?? '' }}
                                </span>
                            </a>
                        </div>
                        <!-- // number -->
                    </div>
                    <!-- // numbers and mail -->
                    <!-- opening and branches -->
                    <div class="article__side-block">
                        <!-- opening times -->
                        <div class="overlay-bg opening" data-aos="zoom-out-up">
                            <div class="overlay-bg__icon">
                                <svg class="icon">
                                    <use href="/web/assets/images/icons/icons.svg#dental"></use>
                                </svg>
                            </div>
                            {!! $settings['timework.home.page'][app()->getLocale()] ?? '' !!}
                        </div>
                        <!-- // opening times -->
                        <!-- opening times -->
                        <div class="overlay-bg opening" data-aos="zoom-out-up">
                            <div class="overlay-bg__icon">
                                <svg class="icon">
                                    <use href="/web/assets/images/icons/icons.svg#derma"></use>
                                </svg>
                            </div>
                            {!! $settings['timework.derma.home.page'][app()->getLocale()] ?? '' !!}
                        </div>
                        <!-- // opening times -->
                        <!-- opening times -->
                        <div class="overlay-bg opening" data-aos="zoom-out-up">
                            <div class="overlay-bg__icon">
                                <svg class="icon">
                                    <use href="/web/assets/images/icons/icons.svg#medical"></use>
                                </svg>
                            </div>
                            {!! $settings['timework.medical.home.page'][app()->getLocale()] ?? '' !!}
                        </div>
                        <!-- nearest branch -->
                        <div class="overlay-bg nearest-branch" data-toggle="modal" data-target="#nearestBranch" data-aos="zoom-out-up"
                             data-aos-delay="100">
                            <div class=" overlay-bg__icon">
                                <svg class="icon">
                                    <use href="/web/assets/images/icons/icons.svg#location"></use>
                                </svg>
                            </div>
                            {!! $settings['briefbranches.home.page'][app()->getLocale()] ?? '' !!}
                        </div>
                        <!-- // nearest branch -->
                    </div>
                    <!-- // opening and branches -->
                    <!-- nearest branch model -->
                    <div class="modal fade" id="nearestBranch" tabindex="-1" aria-labelledby="nearestBranchLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg modal-dialog-centered">
                            <div class="modal-content">
                                <button type="button" class="close ml-auto" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                <div class="modal-header">
                                    <h4 class="modal-title" id="nearestBranchLabel">
                                        {{ __('messages.branch nearest') }}
                                    </h4>
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
                                                            <use href="/web/assets/images/icons/icons.svg#{{ $serv->icon }}"></use>
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
                                                <option value="">{{ __('messages.Do you want choose') }}</option>
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
                                        <div class="form-group text-center" data-aos="fade-up">
                                            <a onclick="return sendBook();" class="btn btn-brand-primary">
                                                {{ __('messages.Book Now') }}
                                                <svg class="btn-icon">
                                                    <use href="/web/assets/images/icons/icons.svg#book"></use>
                                                </svg>
                                            </a>
                                            <a href="{{ route('web.branches.index', ['locale' => app()->getLocale()]) }}" class="btn btn-white">
                                                {{ __('messages.View all branches') }}
                                            </a>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- // nearest branch model -->
                </div>
                <!-- // info -->
            </div>
        </div>
    </section>
    <!-- // contact -->


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


@endsection

@section('submit.scripts')
    <script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.9/jquery.validate.js"></script>
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
    <script type='text/javascript'>

        function validateContact(tel) {

            var xyz=document.getElementById('contactPhone').value.trim();

            var  phoneno = /^\d{10}$/;
            if((tel.value.match(phoneno)) && tel.value.length == 10 && xyz.substr(0,2)==='05' && $.isNumeric(xyz))
            {
                $(tel).removeClass('is-invalid');
                $(tel).addClass('is-valid');

            }
            else
            {
                $("#contactPhone").val('');
                $(tel).removeClass('is-valid');
                $(tel).addClass('is-invalid');

            }
        }
        $('.form').validate({
            rules: {
                name:"required",
                content:"required",
                phone:"required",
                email: {
                    required: true,
                    email: true
                }
            },
            messages: {
                email: "{{__('messages.mailval')}}",
                name: "{{__('messages.namerequired')}}",
                phone: "{{__('messages.phonerequired')}}",
                content: "{{__('messages.messagerequired')}}",
            },
        });
    </script>
@endsection
