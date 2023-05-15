@extends('web.layouts.base')

@section('styles')
    <link rel="stylesheet" href="{{latest('/web/assets2/css/careers'.((app()->getLocale() == 'ar') ? '-rtl' : '').'.min.css')}}" crossorigin="anonymous">

@endsection
@section('pageTitle')
{{ __("messages.Apply For") }} | {{ $job->name }}
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
<a href="{{ route(Route::currentRouteName(), array_replace(Route::getCurrentRoute()->parameters(), ['lang' =>'en' ])) }}" class="d-xl-none lang">English</a>
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
                {{ __("messages.Apply For") }} <br>
                {{ $job->name }}
            </h1>
            <!-- title -->
        </div>
    </div>
    <!-- // page header -->


    <!-- career apply -->
    <section class="career-apply d-pad">
        <div class="container">
            <!-- title -->
            <div class="section-title">
                <h2 class="title" data-aos="fade-up">
                    {{ __("messages.We are glad you joined us!") }}
                </h2>
            </div>
            <!-- // title -->
            <!-- description -->
            <div class="careers__container" data-aos="fade-up">
                <h3 class="h5">{{ __("messages.Personal Information") }}: </h3>
                <form method="POST" enctype="multipart/form-data" action="{{ route('web.jobs.store', app()->getLocale() == 'en' ? ['lang' => 'en'] : '') }}" class="article__form">
                @csrf
                    <input type="hidden" name="job_id" value="{{$job->id}}">
                    <!-- name -->
                    <div class="form-group row d-flex align-items-center">
                        <label for="applyName" class="col-lg-3 col-form-label">{{ __("messages.Full Name") }}</label>
                        <div class="col-lg-9">
                            <input type="text" name="name" class="form-control" id="applyName" placeholder="{{ __("messages.Full Name") }}">
                        </div>
                    </div>
                    <!-- // name -->
                    <!-- date of birth -->
                    <div class="form-group row d-flex align-items-center">
                        <label for="applyDOB" class="col-lg-3 col-form-label">{{ __("messages.Date of Birth") }}</label>
                        <div class="col-lg-9">
                            <input type="date" name="birthdate" class="form-control" id="applyDOB">
                        </div>
                    </div>
                    <!-- // date of birth -->
                    <!-- phone -->
                    <div class="form-group row d-flex align-items-center">
                        <label for="applyPhone" class="col-lg-3 col-form-label">{{ __("messages.Phone Number") }}</label>
                        <div class="col-lg-9">
                            <input type="tel" class="form-control" name="phone"  id="applyPhone" onchange="validateContact(this)" maxlength="10" placeholder="{{ __("messages.Phone Number") }} (05xxxxxxxx).">
                            <div class="invalid-feedback">
                                {{ (app()->getLocale() == 'ar') ? 'يجب أن يكون هذا الحقل جوالًا سعوديًا (05xxxxxxxx).' : 'This field must be saudi arabia mobile (05xxxxxxxx).'}}
                            </div>
                        </div>
                    </div>
                    <!-- // phone -->
                    <!-- email -->
                    <div class="form-group row d-flex align-items-center">
                        <label for="applyEmail" class="col-lg-3 col-form-label">{{ __("messages.Email Address") }}</label>
                        <div class="col-lg-9">
                            <input type="email" class="form-control" name="email"  id="applyEmail" placeholder="{{ __("messages.Email Address") }}">
                        </div>
                    </div>
                    <!-- // email -->
                    <!-- nationality -->
                    <div class="form-group row d-flex align-items-center">
                        <label for="applyNationality" class="col-lg-3 col-form-label">{{ __("messages.Nationality") }}</label>
                        <div class="col-lg-9">
                            <input type="text" name="nationality" class="form-control" id="applyNationality" placeholder="{{ __("messages.Nationality") }}">
                        </div>
                    </div>
                    <!-- // nationality -->
                    <!-- resume -->
                    <div class="form-group row d-flex align-items-center">
                        <label for="applyResume" class="col-lg-3 col-form-label">{{ __("messages.Resume") }}</label>
                        <div class="col-lg-9">
                            <div class="custom-file">
                                <input type="file" name="resume" class="custom-file-input" id="applyResume">
                                <label class="custom-file-label" for="applyResume">{{ __("messages.Choose file") }}</label>
                            </div>
                        </div>
                    </div>
                    <!-- // resume -->
                    <!-- btn -->
                    <div class="row d-flex align-items-center">
                        <div class="col-lg-3"></div>
                        <div class="col-lg-9">
                            <button class="btn btn-brand-primary btn-form" type="submit">
                                {{ __("messages.Send") }}
                            </button>
                        </div>
                    </div>
                    <!-- btn -->
                </form>
            </div>
            <!-- // description -->
        </div>
    </section>
    <!-- // career apply -->

@endsection
@section('submit.scripts')
<script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.9/jquery.validate.js"></script>
<script type='text/javascript'>

        function validateContact(tel) {

        var xyz=document.getElementById('applyPhone').value.trim();

        var  phoneno = /^\d{10}$/;
        if((tel.value.match(phoneno)) && tel.value.length == 10 && xyz.substr(0,2)==='05' && $.isNumeric(xyz))
            {
                $(tel).removeClass('is-invalid');
                $(tel).addClass('is-valid');

            }
        else
            {
                $("#applyPhone").val('');
                $(tel).removeClass('is-valid');
                $(tel).addClass('is-invalid');

            }
        }
        $('.article__form').validate({
        rules: {
                name:"required",
                birthdate:"required",
                phone:"required",
                nationality:"required",
                resume:"required",
                email: {
                    required: true,
                    email: true
                }
            },
            messages: {
                email: "{{__('messages.mailval')}}",
                name: "{{__('messages.namerequired')}}",
                phone: "{{__('messages.phonerequired')}}",
                birthdate: "{{ (app()->getLocale() == 'ar') ? 'أدخل تاريخ ميلادك' : 'Enter your date of birth' }}",
                nationality: "{{ (app()->getLocale() == 'ar') ? 'أدخل جنسيتك' : 'Enter your nationality' }}",
                resume: "{{ (app()->getLocale() == 'ar') ? 'أدخل سيرتك الذاتية' : 'Enter your CV' }}",
            },
        });


</script>
@endsection


