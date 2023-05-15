@extends('web.layouts.base')

@section('styles')
    <link rel="stylesheet preload" href="{{latest('/web/assets2/css/book'.((app()->getLocale() == 'ar') ? '-rtl' : '') .'.min.css')}}" as="style" crossorigin>

@endsection

@section('pageTitle'){{ settings()->get('metatitle.book') ? settings()->get('metatitle.book') : __('messages.Book Your Appointment Now') }}@endsection

@section('metaKeys')
    {!! settings()->get('book.ceo') !!}
@endsection

@section('slug')
    <li class="list-inline-item d-none d-xl-inline-block">
        <a href="{{ url(app()->getLocale() != 'ar' ? 'book-an-appointment' : 'book-an-appointment?lang=en') }}" class="lang">
            {{ app()->getLocale() != 'ar' ? __('messages.ar') : __('messages.en') }}
        </a>
    </li>
@endsection

@section('lang-mobile')
    <a href="{{ url(app()->getLocale() != 'ar' ? 'book-an-appointment' : 'book-an-appointment?lang=en') }}" class="d-xl-none lang">
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
                    <source srcset="{{latest('/web/assets/images/page-header.webp')}}" type="image/webp">
                    <img src="{{latest('/web/assets/images/page-header.jpg')}}" draggable="false" alt="page image" data-aos="zoom-out">
                </picture>
            </div>
            <!-- // image -->
            <!-- title -->
            <h1 class="h3" data-aos="fade-up" data-aos-delay="100">
            {{ __('messages.Book Your Appointment Now') }}
            </h1>
            <!-- title -->
        </div>
    </div>
    <!-- // page header -->


    <!-- book -->
    <section class="book d-pad">
        <div class="container">
            <!-- title -->
            <div class="section-title">
            {!! settings()->get('book.title.page') !!}
            </div>
            <!-- // title -->
            <div class="book__container">
                <!-- book -->
                <div class="book__form">
                   <form class="form" method="post" action="{{ route('web.booking.store', app()->getLocale() == 'en' ? ['lang' => 'en'] : '') }}">
                    @csrf
                        <h3 class="h5" data-aos="fade-up">{{ __('messages.choosedepart') }}</h3>
                        <!-- department -->
                        <div class="form-group row d-flex align-items-center" data-aos="fade-up">
                            <label class="col-lg-3 col-form-label">{{ __('messages.Department') }}</label>
                            <div class="col-lg-9">
                                <nav class="services-nav">
                                    @if(!empty($services))
                                        @foreach($services as $serv)
                                        <span onclick="updateServiceId({{ $serv->id }})" id="services-{{ $serv->id }}" class="btn btn-brand-primary-5 {{ $serviceId == $serv->id  ? 'active' : '' }} ">
                                            <svg class="icon">
                                                <use href="{{latest('/web/assets/images/icons/icons.svg#'. $serv->icon )}}"></use>
                                            </svg>
                                            {{ $serv->name }}
                                        </span>
                                        @endforeach
                                    @endif
                                </nav>
                            </div>
                        </div>
                        <input type="hidden" name="source_ads" value="{{ request()->get('source') }}">
                        <input type="hidden" id="ServiceId" name="service" value="{{ $serviceId }}">
                        <!-- // department -->
                        <!-- branch -->
                        <div class="form-group row d-flex align-items-center" data-aos="fade-up">
                            <label for="bookBranch" class="col-lg-3 col-form-label">{{ __('messages.Branch') }}</label>
                            <div class="col-lg-9">
                                <select class="custom-select" @if($request->speciality == null) onchange="return ResetServices();" @endif id="bookBranch" name="branche_id" required>
                                    @if($request->doctor == null && $request->branche == null && $request->speciality == null)
                                        <option value="">{{ __('messages.brancherequired') }}</option>
                                        @if(!empty($countries))
                                            @foreach($countries as $country)
                                            <optgroup label="{{ $country->name }}">
                                                @foreach($country->branche as $branch)
                                                <option value="{{ $branch->id }}" {{ $request->branche == $branch->id ? 'selected' : '' }}>{{ $branch->name }}</option>
                                                @endforeach
                                            </optgroup>
                                            @endforeach
                                        @endif
                                    @else
                                        @if(!empty($countries))
                                           @if(!empty($request->speciality))
                                           <option value="">{{ __('messages.brancherequired') }}</option>
                                           @endif
                                            @foreach($countries as $country)
                                            <optgroup label="{{ $country->name }}">
                                                @foreach($country->branche as $branch)
                                                <option value="{{ $branch->id }}" {{ $request->branche == $branch->id ? 'selected' : '' }}>{{ $branch->name }}</option>
                                                @endforeach
                                            </optgroup>
                                            @endforeach
                                        @endif
                                    @endif
                                </select>
                            </div>
                        </div>
                        <!-- // branch -->
                        <!-- service -->
                        <div class="form-group row d-flex align-items-center" data-aos="fade-up">
                            <label for="bookService" class="col-lg-3 col-form-label">{{ __('messages.service') }}</label>
                            <div class="col-lg-9">
                                <select class="custom-select" @if($request->doctor == null) onchange="return showDoctors();" @endif  id="bookService" name="speciality" required>
                                    @if($request->doctor == null && $request->speciality == null && $request->branche == null)
                                        @if(!empty($services))
                                        <option value="">{{ __('messages.specialityrequired') }}</option>
                                            @foreach($services as $service)
                                            <optgroup label="{{ $service->name }}">
                                                @foreach($service->specialities as $specialit)
                                                <option value="{{ $specialit->id }}" {{ $request->speciality == $specialit->id ? 'selected' : '' }}>{{ $specialit->name }}</option>
                                                @endforeach
                                            </optgroup>
                                            @endforeach
                                        @endif
                                    @else
                                        @if($request->doctor == null)
                                        <option value="">{{ __('messages.specialityrequired') }}</option>
                                        @endif
                                        <optgroup label="{{ $servicesFirst->name }}">
                                            @foreach($specialities as $specialit)
                                            <option value="{{ $specialit->id }}" {{ $request->speciality == $specialit->id ? 'selected' : '' }}>{{ $specialit->name }}</option>
                                            @endforeach
                                        </optgroup>
                                    @endif
                                </select>
                            </div>
                        </div>
                        <!-- // service -->
                        <!-- doctor -->
                        <div class="form-group row d-flex align-items-center" data-aos="fade-up">
                            <label for="bookDoctor" class="col-lg-3 col-form-label">{{ __('messages.doctor') }}</label>
                            <div class="col-lg-9">
                                <select class="custom-select" onchange="return showAvailableAppointments();" id="bookDoctor" name="doctor_id" required>
                                    @if($request->doctor == null)
                                        <option value="">{{ __('messages.doctorrequired') }}</option>
                                        @if(!empty($doctors))
                                            @foreach($doctors as $doctor)
                                            <option value="{{ $doctor->id }}" {{ $request->doctor == $doctor->id ? 'selected' : '' }}>{{ $doctor->name }}</option>
                                            @endforeach
                                        @endif
                                    @else
                                    <option value="{{ $GetdoctorId->id }}" {{ $request->doctor == $GetdoctorId->id ? 'selected' : '' }}>{{ $GetdoctorId->name }}</option>
                                    @endif
                                </select>
                            </div>
                        </div>
                        <!-- // doctor -->



                        <h3 class="h5" data-aos="fade-up">{{ __('messages.Personal Information') }}</h3>
                        <!-- name -->
                        <div class="form-group row d-flex align-items-center" data-aos="fade-up">
                            <label for="bookName" class="col-lg-3 col-form-label">{{ __('messages.Full Name') }}</label>
                            <div class="col-lg-9">
                                <input type="text" class="form-control" id="bookName" placeholder="{{ __('messages.namerequired') }}" name="name" value="{{ old('name') }}" required>
                            </div>
                        </div>
                        <!-- // name -->
                        <!-- phone -->
                        <div class="form-group row d-flex align-items-center" data-aos="fade-up">
                            <label for="bookPhone" class="col-lg-3 col-form-label">{{ __('messages.Phone') }}</label>
                            <div class="col-lg-9">
                                <input type="tel" class="form-control" onchange="validateContact(this)" maxlength="10" id="bookPhone"  placeholder="{{ __('messages.phonerequired') }} (05xxxxxxxx)." name="phone" value="{{ old('phone') }}" required>
                                <div class="invalid-feedback">
                                 {{ (app()->getLocale() == 'ar') ? 'يجب أن يكون هذا الحقل جوالًا سعوديًا (05xxxxxxxx).' : 'This field must be saudi arabia mobile (05xxxxxxxx).'}}
                                </div>
                            </div>
                        </div>
                        <!-- // phone -->
                        <!-- email -->
                        <div class="form-group row d-flex align-items-center" data-aos="fade-up">
                            <label for="bookEmail" class="col-lg-3 col-form-label">{{ __('messages.Email Address') }}</label>
                            <div class="col-lg-9">
                                <input type="email" class="form-control" id="bookEmail" placeholder="{{ __('messages.emailrequired') }}" name="email" value="{{ old('email') }}" required>
                            </div>
                        </div>
                        <!-- // email -->
                        <!-- date -->
                        <div class="form-group row d-flex align-items-center" data-aos="fade-up">
                            <label for="bookDate" class="col-lg-3 col-form-label">{{ __('messages.Date') }}</label>
                            <div class="col-lg-9">
                                <input onchange="return checkAvailableAppointment();"  type="date" class="form-control" name="attendance_date" value="{{ old('attendance_date') }}" id="bookDate" required>
                            </div>
                        </div>
                        <!-- // date -->
                        <!-- time -->
                        <div class="form-group row d-flex align-items-center" data-aos="fade-up">
                            <label for="bookTime1" class="col-lg-3 col-form-label">{{ (app()->getLocale() == 'ar') ? 'التوقيت' : 'Time'}}</label>
                            <div class="col-lg-9">
                                <select class="custom-select" id="bookTime1" name="available_time" required>
                                    <option value="">{{ __('messages.timerequired') }}</option>
                                    <option value="{{ (app()->getLocale() == 'ar') ? 'صباحي' : 'Morning'}}">{{ (app()->getLocale() == 'ar') ? 'صباحي' : 'Morning'}}</option>
                                    <option value="{{ (app()->getLocale() == 'ar') ? 'مسائي' : 'Evening'}}">{{ (app()->getLocale() == 'ar') ? 'مسائي' : 'Evening'}}</option>
                                </select>
                            </div>
                        </div>
                        <!-- <div class="form-group row d-flex align-items-center" data-aos="fade-up">
                            <label for="bookTime" class="col-lg-3 col-form-label">{{ __('messages.Book Time') }}</label>
                            <div class="col-lg-9">
                                <select class="custom-select" id="bookTime" name="" >
                                    <option value="">{{ __('messages.timerequired') }}</option>
                                </select>
                                @if (request()->get('availability') == 1)
                                <label for="bookTime" generated="true" class="error">{{ __('messages.Already Booked') }}</label>
                                @endif
                            </div>
                        </div> -->
                        <!-- // time -->
                        <!-- btn -->
                        <div class="row d-flex align-items-center">
                            <div class="col-lg-3"></div>
                            <div class="col-lg-9">
                                <button type="submit" class="btn btn-brand-primary btn-form Booking_ads" data-aos="fade-up">
                                {{ __('messages.Book Your Appointment Now') }}
                                    <svg class="btn-icon">
                                        <use href="{{latest('/web/assets/images/icons/icons.svg#book')}}"></use>
                                    </svg>
                                </button>
                            </div>
                        </div>
                        <!-- // btn -->
                    </form>
                </div>
                <!-- // book -->
                <!-- image -->
                <div class="book__image">
                    <picture>
                        <source srcset="{{latest('/web/assets/images/book.webp')}}" type="image/webp">
                        <img src="{{ latest(settings()->get('book.image.page')) }}" draggable="false" alt="book now" data-aos="zoom-out">
                    </picture>
                </div>
                <!-- // image -->
            </div>
        </div>
    </section>
    <!-- // book -->
@endsection

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
<script>

       $(document).ready(function () {
         service_id = $("#ServiceId").val();
         $("#services-"+ service_id +"").addClass("active");
         $("#ServiceId").val(service_id);

         doctorId = $("#bookDoctor option:selected").val();
         branchId = $("#bookBranch option:selected").val();
         specialityId = $("#bookService option:selected").val();
         if(doctorId){
            // showAvailableAppointments();

         }else if(branchId){


            showDoctors();

        }else if(specialityId){

            showDoctors();
         }else{
            updateServiceId(service_id);
            showDoctors();
         }

        })

        function ResetServices() {
            $('#bookService option:selected').prop('selected', false);
        }

        function updateServiceId(btnId) {

            $(".services-nav span").removeClass("active");
            $("#services-"+ btnId +"").addClass("active");
            $("#ServiceId").val(btnId);
            service_id = $("#ServiceId").val();
            doctorId = $("#bookDoctor option:selected").val();
            branchId = $("#bookBranch option:selected").val();
            //empty all seclect

            if(!(doctorId)){
                var select = $("#bookBranch");
                select.empty();
                var content = '<option value="">{{ __('messages.brancherequired') }}</option>';
                select.append(content);
            }
            if(!(doctorId)){
                var selectspecialt = $("#bookService");
                selectspecialt.empty();
                var contentspecialt = '<option value="">{{ __('messages.specialityrequired') }}</option>';
                selectspecialt.append(contentspecialt);
            }
            if(!(doctorId)){
                var selectdoctor = $("#bookDoctor");
                selectdoctor.empty();
                var contentdoctor = '<option value="">{{ __('messages.doctorrequired') }}</option>';
                selectdoctor.append(contentdoctor);
            }
            var selecttime = $("#bookTime");
            selecttime.empty();
            var contenttime = '<option value="">{{ __('messages.timerequired') }}</option>';
            selecttime.append(contenttime);


            if (service_id && !(branchId)) {
                $.ajax({
                    type: 'GET',
                    url: route('api.branches.services', {
                        'lang': '{{ app()->getLocale() }}',
                        'service': service_id
                    }),
                    processData: false,
                    contentType: false,
                    success: function (data) {
                        var select = $("#bookBranch");
                        // var selectspecialt = $("#bookService");
                        select.empty();
                        // selectspecialt.empty();
                        var content = '<option value="">{{ __('messages.brancherequired') }}</option>';
                        // var contentspecialt = '<option value="">{{ __('messages.specialityrequired') }}</option>';
                        select.append(content);
                        // selectspecialt.append(contentspecialt);
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
                       var selectspecialt = $("#bookService");
                       selectspecialt.empty();
                       var contentspecialt = '<option value="">{{ __('messages.specialityrequired') }}</option>';
                       selectspecialt.append(contentspecialt);
                            if(data.specialities.length > 0){
                             selectspecialt.append('<optgroup label="' + data.services.name + '">');
                           }
                           $.each(data.specialities, function (index, specialit) {
                                   var content2 = '<option value="' + specialit.id + '">' + specialit.name + '</option>';
                                   selectspecialt.append(content2);
                           });
                           if(data.specialities.length > 0){
                            selectspecialt.append('</optgroup>');
                            }
                           showDoctors();
                   },
                   error: function (data) {
                   }
               });
            }

        }



        function showDoctors() {

           service_id = $("#ServiceId").val();
           brancheId  = $("#bookBranch option:selected").val();
           specialtId  = $("#bookService option:selected").val();

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
                        var selectdoctor = $("#bookDoctor");
                        selectdoctor.empty();
                        var contentdoctor = '<option value="">{{ __('messages.doctorrequired') }}</option>';
                        selectdoctor.append(contentdoctor);
                            $.each(data.doctors, function (index, doctor) {
                                    var content3 = '<option value="' + doctor.id + '">' + doctor.name + '</option>';
                                    selectdoctor.append(content3);
                            });
                            showAvailableAppointments();
                    },
                    error: function (data) {
                    }
                });

            }
       }

       function showAvailableAppointments() {
            doctorId = $("#bookDoctor option:selected").val();
            if (doctorId) {
                $.ajax({
                    type: 'GET',
                    url: route('api.doctors.working.hours', {'doctor': doctorId}),
                    processData: false,
                    contentType: false,
                    success: function (data) {
                        // console.log(data);
                        var selecttime = $("#bookTime");
                        selecttime.empty();
                        var contenttime = '<option value="">{{ __('messages.timerequired') }}</option>';
                        selecttime.append(contenttime);
                        $.each(data, function (index, time) {
                            var contenttime = '<option value="' + time + '">' + time + '</option>';
                            selecttime.append(contenttime);
                        });
                        checkAvailableAppointment();
                    },
                    error: function (data) {
                    }
                });
            }
        }


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


</script>
<script type='text/javascript'>

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
@endsection

