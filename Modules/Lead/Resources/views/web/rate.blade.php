@extends('web.layouts.base')

@section('styles')
    <link rel="stylesheet preload" href="{{latest('/web/assets2/css/rate'. ((app()->getLocale() == 'ar') ? '-rtl' : '') .'.min.css')}}" as="style" crossorigin>
@endsection

@section('metaKeys')
    {!! $settings['rate.seo'][app()->getLocale()] ?? '' !!}
@endsection

@section('pageTitle')
    {{ __('messages.Rate Your Experience') }}
@endsection

@section('slug')
    @if(app()->getLocale() == 'ar')
        <li class="list-inline-item d-none d-xl-inline-block">
            <a href="{{ route(Route::currentRouteName(), array_replace(Route::getCurrentRoute()->parameters(), ['lang' =>'en' ])) }}" class="lang">
                English
            </a>
        </li>
    @else
        <li class="list-inline-item d-none d-xl-inline-block">
            <a href="{{ route(Route::currentRouteName(), array_replace(Route::getCurrentRoute()->parameters())) }}" class="lang">
                عربي
            </a>
        </li>
    @endif
@endsection

@section('lang-mobile')
    @if(app()->getLocale() == 'ar')
        <a href="{{ route(Route::currentRouteName(), array_replace(Route::getCurrentRoute()->parameters(), ['locale' =>'en' ])) }}" class="d-xl-none lang">English</a>
    @else
        <a href="{{ route(Route::currentRouteName(), array_replace(Route::getCurrentRoute()->parameters())) }}" class="d-xl-none lang">عربي</a>
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
            <h1 class="h3" data-aos="fade-up" data-aos-delay="100">
                {{ __('messages.Rate Your Experience') }}
            </h1>
            <!-- title -->
        </div>
    </div>
    <!-- // page header -->

    <!-- rate -->
    <section class="rate d-pad">
        <div class="container">
            <!-- title -->
            <div class="section-title">
                <h2 class="title" data-aos="fade-up">
                    {{ __('messages.We are pleased to serve you ') }}<br>
                    <span class="color">{{ __('messages.Rate Your Experience Now') }}</span>
                </h2>
                <p data-aos="fade-up" data-aos-delay="100">
                    {{ __('messages.Evaluate the level of service provided') }}
                </p>
            </div>
            <!-- // title -->
            <form class="form" method="post" action="{{ route('web.leads.store-rate', app()->getLocale() == 'en' ? ['lang' => 'en'] : '')}}">
               @csrf
                <div class="rate__container">
                    <!-- form -->
                    <div class="rate__form">
                        <h3 class="h5" data-aos="fade-up">{{ __('messages.choosedepart') }}</h3>
                        <!-- department -->
                        <div class="form-group row d-flex align-items-center" data-aos="fade-up">
                            <label class="col-lg-3 col-form-label">{{ __('messages.Department') }}</label>
                            <div class="col-lg-9">
                                <nav class="services-nav">
                                    @if(!empty($services))
                                        @foreach($services as $serv)
                                            <span onclick="updateServiceId({{ $serv->id }})" id="services-{{ $serv->id }}" class="btn btn-brand-primary-5 {{ $loop->first ? 'active' : '' }} ">
                                            <svg class="icon">
                                                <use href="{{latest('/web/assets/images/icons/icons.svg#'. $serv->icon) }}"></use>
                                            </svg>
                                            {{ $serv->name }}
                                        </span>
                                        @endforeach
                                    @endif
                                </nav>
                            </div>
                        </div>
                        <input type="hidden" id="ServiceId" name="service" value="1">
                        <input type="hidden" name="source" value="rates">
                        <input type="hidden" name="offer_id" value="1">
                        <!-- // department -->
                        <!-- branch -->
                        <div class="form-group row d-flex align-items-center" data-aos="fade-up">
                            <label for="freeProgramBranch" class="col-lg-3 col-form-label">{{ __('messages.Branch') }}</label>
                            <div class="col-lg-9">
                                <select class="custom-select" onchange="return ResetServices();" id="freeProgramBranch" name="branche_id" required>
                                    <option value="">{{ __('messages.brancherequired') }}</option>
                                    @if(!empty($countries))
                                        @foreach($countries as $country)
                                            <optgroup label="{{ $country->name }}">
                                                @foreach($country->branche as $branch)
                                                    <option value="{{ $branch->id }}" {{ $request->branche_id == $branch->id ? 'selected' : '' }}>{{ $branch->name }}</option>
                                                @endforeach
                                            </optgroup>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                        <!-- // branch -->
                        <!-- service -->
                        <div class="form-group row d-flex align-items-center" data-aos="fade-up">
                            <label for="freeProgramService" class="col-lg-3 col-form-label">{{ __('messages.service') }}</label>
                            <div class="col-lg-9">
                                <select class="custom-select" onchange="return showDoctors();"  id="freeProgramService" name="speciality_id" required>
                                    <option value="">{{ __('messages.specialityrequired') }}</option>
                                    @if(!empty($services))
                                        @foreach($services as $service)
                                            <optgroup label="{{ $service->name }}">
                                                @foreach($service->specialities as $specialit)
                                                    <option value="{{ $specialit->id }}" {{ $request->speciality_id == $specialit->id ? 'selected' : '' }}>{{ $specialit->name }}</option>
                                                @endforeach
                                            </optgroup>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                        <!-- // service -->
                        <!-- doctor -->
                        <div class="form-group row d-flex align-items-center" data-aos="fade-up">
                            <label for="freeProgramDoctor" class="col-lg-3 col-form-label">{{ __('messages.doctor') }}</label>
                            <div class="col-lg-9">
                                <select class="custom-select"  id="freeProgramDoctor" name="doctor_id" required>
                                    <option value="">{{ __('messages.doctorrequired') }}</option>
                                    @if(!empty($doctors))
                                        @foreach($doctors as $doctor)
                                            <option value="{{ $doctor->id }}" {{ $request->doctor_id == $doctor->id ? 'selected' : '' }}>{{ $doctor->name }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                        <!-- // doctor -->


                        <h3 class="h5" data-aos="fade-up">{{ __('messages.Personal Information') }}</h3>
                        <!-- name -->
                        <div class="form-group row d-flex align-items-center" data-aos="fade-up">
                            <label for="freeProgramName" class="col-lg-3 col-form-label">{{ __('messages.Full Name') }}</label>
                            <div class="col-lg-9">
                                <input type="text" class="form-control" id="freeProgramName" placeholder="{{ __('messages.namerequired') }}" name="name" value="{{ old('name') }}" required>
                            </div>
                        </div>
                        <!-- // name -->
                        <!-- phone -->
                        <div class="form-group row d-flex align-items-center" data-aos="fade-up">
                            <label for="freeProgramPhone" class="col-lg-3 col-form-label">{{ __('messages.Phone') }}</label>
                            <div class="col-lg-9">
                                <input type="tel" class="form-control" onchange="validateContact(this)" maxlength="10" id="freeProgramPhone" placeholder="{{ __('messages.phonerequired') }} (05xxxxxxxx)." name="phone" value="{{ old('phone') }}" required>
                                <div class="invalid-feedback">
                                 {{ (app()->getLocale() == 'ar') ? 'يجب أن يكون هذا الحقل جوالًا سعوديًا (05xxxxxxxx).' : 'This field must be saudi arabia mobile (05xxxxxxxx).'}}
                                </div>
                            </div>
                        </div>
                        <!-- // phone -->
                        <!-- email -->
                        <div class="form-group row d-flex align-items-center" data-aos="fade-up">
                            <label for="freeProgramEmail" class="col-lg-3 col-form-label">{{ __('messages.Email Address') }}</label>
                            <div class="col-lg-9">
                                <input type="email" class="form-control" id="freeProgramEmail" placeholder="{{ __('messages.emailrequired') }}" name="email" value="{{ old('email') }}" required>
                            </div>
                        </div>
                        <!-- // email -->
                        <!-- btn -->
                        <div class="row d-flex align-items-center">
                            <div class="col-lg-3"></div>
                            <div class="col-lg-9">
                                <button type="submit" class="btn btn-brand-primary btn-form" data-aos="fade-up">
                                    {{ __('messages.Rate Your Experience') }}
                                </button>
                            </div>
                        </div>
                        <!-- // btn -->
                    </div>
                    <!-- // form -->
                    <!-- values -->
                    <div class="rate__values">
                        <h3 class="h5" data-aos="fade-up">{{ __('messages.Rating') }}</h3>
                        <!-- value -->
                        <div class="rate__value" data-aos="fade-up">
                            <h4 class="h6">{{ (app()->getLocale() == 'ar') ? 'مدى سهولة حجز المواعيد ؟' : 'How easy is it to book appointments?'}}</h4>
                            <input type="hidden" name="name_rate1" value="How easy is it to book appointments?">
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" id="rate1CompletelySatisfied" name="rate1" value="CompletelySatisfied" class="custom-control-input">
                                <label class="custom-control-label" for="rate1CompletelySatisfied">{{ __('messages.Completely Satisfied') }}</label>
                            </div>
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" id="rate1Satisfied" name="rate1" value="Satisfied" class="custom-control-input" checked>
                                <label class="custom-control-label" for="rate1Satisfied">{{ __('messages.Satisfied') }}</label>
                            </div>
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" id="rate1NotSatisfied" name="rate1" value="NotSatisfied" class="custom-control-input">
                                <label class="custom-control-label" for="rate1NotSatisfied">{{ __('messages.Not Satisfied') }}</label>
                            </div>
                        </div>
                        <!-- // value -->
                        <!-- value -->
                        <div class="rate__value" data-aos="fade-up">
                            <h4 class="h6">{{ (app()->getLocale() == 'ar') ? 'مدى رضاكم عن الوقت المستغرق خلال رحلتكم العلاجية داخل العيادات؟' : 'How satisfied are you with the time spent during your treatment journey inside the clinics?'}}</h4>
                            <input type="hidden" name="name_rate2" value="How satisfied are you with the time spent during your treatment journey inside the clinics?">
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" id="rate2CompletelySatisfied" name="rate2" value="CompletelySatisfied" class="custom-control-input">
                                <label class="custom-control-label" for="rate2CompletelySatisfied">{{ __('messages.Completely Satisfied') }}</label>
                            </div>
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" id="rate2Satisfied" name="rate2" value="Satisfied" class="custom-control-input" checked>
                                <label class="custom-control-label" for="rate2Satisfied">{{ __('messages.Satisfied') }}</label>
                            </div>
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" id="rate2NotSatisfied" name="rate2" value="NotSatisfied" class="custom-control-input">
                                <label class="custom-control-label" for="rate2NotSatisfied">{{ __('messages.Not Satisfied') }}</label>
                            </div>
                        </div>
                        <!-- // value -->
                        <!-- value -->
                        <div class="rate__value" data-aos="fade-up">
                            <h4 class="h6">{{ (app()->getLocale() == 'ar') ? 'مدى رضاكم عن سعر الخدمة؟' : 'How satisfied are you with the price of the service?'}}</h4>
                            <input type="hidden" name="name_rate3" value="How satisfied are you with the price of the service?">
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" id="rate3CompletelySatisfied" name="rate3" value="CompletelySatisfied" class="custom-control-input">
                                <label class="custom-control-label" for="rate3CompletelySatisfied">{{ __('messages.Completely Satisfied') }}</label>
                            </div>
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" id="rate3Satisfied" name="rate3" value="Satisfied" class="custom-control-input" checked>
                                <label class="custom-control-label" for="rate3Satisfied">{{ __('messages.Satisfied') }}</label>
                            </div>
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" id="rate3NotSatisfied" name="rate3" value="NotSatisfied" class="custom-control-input">
                                <label class="custom-control-label" for="rate3NotSatisfied">{{ __('messages.Not Satisfied') }}</label>
                            </div>
                        </div>
                        <!-- // value -->
                        <!-- value -->
                        <div class="rate__value" data-aos="fade-up">
                            <h4 class="h6">{{ (app()->getLocale() == 'ar') ? 'مدى رضاكم عن الخدمة الطبية المقدمة؟' : 'How satisfied are you with the provided medical service?'}}</h4>
                            <input type="hidden" name="name_rate4" value="How satisfied are you with the provided medical service?">
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" id="rate4CompletelySatisfied" name="rate4" value="CompletelySatisfied" class="custom-control-input">
                                <label class="custom-control-label" for="rate4CompletelySatisfied">{{ __('messages.Completely Satisfied') }}</label>
                            </div>
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" id="rate4Satisfied" name="rate4" value="Satisfied" class="custom-control-input" checked>
                                <label class="custom-control-label" for="rate4Satisfied">{{ __('messages.Satisfied') }}</label>
                            </div>
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" id="rate4NotSatisfied" name="rate4" value="NotSatisfied" class="custom-control-input">
                                <label class="custom-control-label" for="rate4NotSatisfied">{{ __('messages.Not Satisfied') }}</label>
                            </div>
                        </div>
                        <!-- // value -->
                        <!-- value -->
                        <div class="rate__value" data-aos="fade-up">
                            <h4 class="h6">{{ (app()->getLocale() == 'ar') ? 'هل قام الطبيب بشرح الحالة الطبية والحلول المتاحة والتكلفة بالتفصيل؟' : 'Did the doctor explain the medical condition, available solutions, and cost in detail?'}}</h4>
                            <input type="hidden" name="name_rate5" value="Did the doctor explain the medical condition, available solutions, and cost in detail?">
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" id="rate5CompletelySatisfied" name="rate5" value="CompletelySatisfied" class="custom-control-input">
                                <label class="custom-control-label" for="rate5CompletelySatisfied">{{ __('messages.Completely Satisfied') }}</label>
                            </div>
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" id="rate5Satisfied" name="rate5" value="Satisfied" class="custom-control-input" checked>
                                <label class="custom-control-label" for="rate5Satisfied">{{ __('messages.Satisfied') }}</label>
                            </div>
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" id="rate5NotSatisfied" name="rate5" value="NotSatisfied" class="custom-control-input">
                                <label class="custom-control-label" for="rate5NotSatisfied">{{ __('messages.Not Satisfied') }}</label>
                            </div>
                        </div>
                        <!-- // value -->
                        <!-- value -->
                        <div class="rate__value" data-aos="fade-up">
                            <h4 class="h6">{{ (app()->getLocale() == 'ar') ? 'مدى رضاكم عن جودة خدمة الإستقبال؟' : 'How satisfied are you with the quality of the reception service?'}}</h4>
                            <input type="hidden" name="name_rate6" value="How satisfied are you with the quality of the reception service?">
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" id="rate6CompletelySatisfied" name="rate6" value="CompletelySatisfied" class="custom-control-input">
                                <label class="custom-control-label" for="rate6CompletelySatisfied">{{ __('messages.Completely Satisfied') }}</label>
                            </div>
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" id="rate6Satisfied" name="rate6" value="Satisfied" class="custom-control-input" checked>
                                <label class="custom-control-label" for="rate6Satisfied">{{ __('messages.Satisfied') }}</label>
                            </div>
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" id="rate6NotSatisfied" name="rate6" value="NotSatisfied" class="custom-control-input">
                                <label class="custom-control-label" for="rate6NotSatisfied">{{ __('messages.Not Satisfied') }}</label>
                            </div>
                        </div>
                        <!-- // value -->
                        <!-- value -->
                        <div class="rate__value" data-aos="fade-up">
                            <h4 class="h6">{{ (app()->getLocale() == 'ar') ? 'مدى رضاكم عن التعقيم والنظافة العامة بالعيادات و مرافقها ؟' : 'How satisfied are you with sterilization and general hygiene in clinics and their facilities?'}}</h4>
                            <input type="hidden" name="name_rate7" value="How satisfied are you with sterilization and general hygiene in clinics and their facilities?">
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" id="rate7CompletelySatisfied" name="rate7" value="CompletelySatisfied" class="custom-control-input">
                                <label class="custom-control-label" for="rate7CompletelySatisfied">{{ __('messages.Completely Satisfied') }}</label>
                            </div>
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" id="rate7Satisfied" name="rate7" value="Satisfied" class="custom-control-input" checked>
                                <label class="custom-control-label" for="rate7Satisfied">{{ __('messages.Satisfied') }}</label>
                            </div>
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" id="rate7NotSatisfied" name="rate7" value="NotSatisfied" class="custom-control-input">
                                <label class="custom-control-label" for="rate7NotSatisfied">{{ __('messages.Not Satisfied') }}</label>
                            </div>
                        </div>
                        <!-- // value -->
                        <!-- value -->
                        <div class="rate__value" data-aos="fade-up">
                            <h4 class="h6">{{ (app()->getLocale() == 'ar') ? 'مدى احتمالية بأن توصي الأخرين بزيارة عيادات رام؟' : 'How likely are you to recommend others to visit Ram Clinics?'}}</h4>
                            <input type="hidden" name="name_rate8" value="How likely are you to recommend others to visit Ram Clinics?">
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" id="rate8CompletelySatisfied" name="rate8" value="CompletelySatisfied" class="custom-control-input">
                                <label class="custom-control-label" for="rate8CompletelySatisfied">{{ __('messages.Completely Satisfied') }}</label>
                            </div>
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" id="rate8Satisfied" name="rate8" value="Satisfied" class="custom-control-input" checked>
                                <label class="custom-control-label" for="rate8Satisfied">{{ __('messages.Satisfied') }}</label>
                            </div>
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" id="rate9NotSatisfied" name="rate8" value="NotSatisfied" class="custom-control-input">
                                <label class="custom-control-label" for="rate9NotSatisfied">{{ __('messages.Not Satisfied') }}</label>
                            </div>
                        </div>
                        <!-- // value -->
                    </div>
                    <!-- // values -->
                </div>
            </form>
        </div>
    </section>
    <!-- // rate -->
@endsection
@section('submit.scripts')

    <script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.9/jquery.validate.js"></script>
    <script>

        $(document).ready(function () {
            service_id = $("#ServiceId").val();
            $("#services-"+ service_id +"").addClass("active");
            $("#ServiceId").val(service_id);

            updateServiceId(service_id);
            showDoctors();

        })

        function ResetServices() {
            $('#freeProgramService option:selected').prop('selected', false);
        }


        function updateServiceId(btnId) {

            $(".services-nav span").removeClass("active");
            $("#services-"+ btnId +"").addClass("active");
            $("#ServiceId").val(btnId);
            service_id = $("#ServiceId").val();

            //empty all seclect

            var select = $("#freeProgramBranch");
            select.empty();
            var content = '<option value="">{{ __('messages.brancherequired') }}</option>';
            select.append(content);

            var selectspecialt = $("#freeProgramService");
            selectspecialt.empty();
            var contentspecialt = '<option value="">{{ __('messages.specialityrequired') }}</option>';
            selectspecialt.append(contentspecialt);

            var selectdoctor = $("#freeProgramDoctor");
            selectdoctor.empty();
            var contentdoctor = '<option value="">{{ __('messages.doctorrequired') }}</option>';
            selectdoctor.append(contentdoctor);


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
                        var select = $("#freeProgramBranch");
                        var selectspecialt = $("#freeProgramService");
                        select.empty();
                        selectspecialt.empty();
                        var content = '<option value="">{{ __('messages.brancherequired') }}</option>';
                        var contentspecialt = '<option value="">{{ __('messages.specialityrequired') }}</option>';
                        select.append(content);
                        selectspecialt.append(contentspecialt);
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

                $.ajax({
                    type: 'GET',
                    url: route('api.services.specificities', {
                        'lang': '{{ app()->getLocale() }}',
                        'service': service_id
                    }),
                    processData: false,
                    contentType: false,
                    success: function (data) {
                        var selectspecialt = $("#freeProgramService");
                        selectspecialt.empty();
                        var contentspecialt = '<option value="">{{ __('messages.specialityrequired') }}</option>';
                        selectspecialt.append(contentspecialt);
                        selectspecialt.append('<optgroup label="' + data.services.name + '">');
                        $.each(data.specialities, function (index, specialit) {
                            var content2 = '<option value="' + specialit.id + '">' + specialit.name + '</option>';
                            selectspecialt.append(content2);
                        });
                        selectspecialt.append('</optgroup>');
                        showDoctors();
                    },
                    error: function (data) {
                    }
                });
            }

        }



        function showDoctors() {

            service_id = $("#ServiceId").val();
            brancheId  = $("#freeProgramBranch option:selected").val();
            specialtId  = $("#freeProgramService option:selected").val();
            if (service_id && brancheId && specialtId) {

                $.ajax({
                    type: 'GET',
                    url: route('api.specificities.doctors', {
                        'lang': '{{ app()->getLocale() }}',
                        'service': service_id,
                        'branche': brancheId,
                        'specificity': specialtId
                    }),
                    processData: false,
                    contentType: false,
                    success: function (data) {
                        var selectdoctor = $("#freeProgramDoctor");
                        selectdoctor.empty();
                        var contentdoctor = '<option value="">{{ __('messages.doctorrequired') }}</option>';
                        selectdoctor.append(contentdoctor);
                        $.each(data.doctors, function (index, doctor) {
                            var content3 = '<option value="' + doctor.id + '">' + doctor.name + '</option>';
                            selectdoctor.append(content3);
                        });

                    },
                    error: function (data) {
                    }
                });

            }
        }
    </script>
    <script type='text/javascript'>

        function validateContact(tel) {

        var xyz=document.getElementById('freeProgramPhone').value.trim();

        var  phoneno = /^\d{10}$/;
        if((tel.value.match(phoneno)) && tel.value.length == 10 && xyz.substr(0,2)==='05' && $.isNumeric(xyz))
            {
                $(tel).removeClass('is-invalid');
                $(tel).addClass('is-valid');
            }
        else
            {
                $("#freeProgramPhone").val('');
                $(tel).removeClass('is-valid');
                $(tel).addClass('is-invalid');
            }
        }
        $('.form').validate({
            rules: {
                branche_id:"required",
                speciality_id:"required",
                doctor_id:"required",
                name:"required",
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
                branche_id: "{{__('messages.brancherequired')}}",
                speciality_id: "{{__('messages.specialityrequired')}}",
                doctor_id: "{{__('messages.doctorrequired')}}",
            },
        });


    </script>
@endsection
