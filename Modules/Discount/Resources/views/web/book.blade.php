@extends('web.layouts.base')

@section('styles')
    <link rel="stylesheet preload" href="{{latest('/web/assets2/css/book'.((app()->getLocale() == 'ar') ? '-rtl' : '').'.min.css')}}" as="style" crossorigin>

@endsection

@section('pageTitle')
{{ __('messages.Book Your Appointment Now') }}
@endsection

@section('slug')
@if(app()->getLocale() == 'ar')
<li class="list-inline-item d-none d-xl-inline-block">
    <a href="{{ route(Route::currentRouteName(), ['lang' =>'en' ]) }}" class="lang">
        English
    </a>
</li>
@else
<li class="list-inline-item d-none d-xl-inline-block">
    <a href="{{ route(Route::currentRouteName()) }}" class="lang">
        عربي
    </a>
</li>
@endif
@endsection
@section('lang-mobile')
@if(app()->getLocale() == 'ar')
<a href="{{ route(Route::currentRouteName(), ['lang' =>'en' ]) }}" class="d-xl-none lang">English</a>
@else
<a href="{{ route(Route::currentRouteName()) }}" class="d-xl-none lang">عربي</a>
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
                    <img src="{{latest('/web/assets/images/page-header.jpg')}}" draggable="false"
                        alt="page image" data-aos="zoom-out">
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
                   <form class="form" method="post" action="{{ route('web.discount-booking.store',['lang' => app()->getLocale()])}}">
                    @csrf
                        <h3 class="h5" data-aos="fade-up">{{ __('messages.choosedepart') }}</h3>
                        <!-- department -->
                        <div class="form-group row d-flex align-items-center" data-aos="fade-up">
                            <label class="col-lg-3 col-form-label">{{ __('messages.Department') }}</label>
                            <div class="col-lg-9">
                                <nav class="services-nav">
                                        <span onclick="updateServiceId({{ $discountcat->id }})" id="services-{{ $discountcat->id }}" class="btn btn-brand-primary-5 active">
                                            <svg class="icon">
                                                <use href="{{latest('/web/assets/images/icons/icons.svg#'.$discountcat->slug) }}"></use>
                                            </svg>
                                            {{ $discountcat->name }}
                                        </span>
                                </nav>
                            </div>
                        </div>
                        <input type="hidden" id="ServiceId" name="service" value="{{ $discountcat->id ? $discountcat->id : '1' }}">
                        <!-- // department -->
                        <!-- branch -->
                        <div class="form-group row d-flex align-items-center" data-aos="fade-up">
                            <label for="bookBranch" class="col-lg-3 col-form-label">{{ __('messages.Branch') }}</label>
                            <div class="col-lg-9">
                                <select class="custom-select" onchange="return showDoctors();" id="bookBranch" name="branche_id" required>
                                        <option value="">{{ __('messages.brancherequired') }}</option>
                                            @foreach($branches as $branch)
                                            <option value="{{ $branch->id }}" {{ $request->branche == $branch->id ? 'selected' : '' }}>{{ $branch->name }}</option>
                                            @endforeach
                                </select>
                            </div>
                        </div>
                        <!-- // branch -->
                        <!-- service -->
                        <div class="form-group row d-flex align-items-center" data-aos="fade-up">
                            <label for="bookService" class="col-lg-3 col-form-label">{{ __('messages.service') }}</label>
                            <div class="col-lg-9">
                                <select class="custom-select"  id="bookService" name="discount_id" required>

                                 <option value="{{ $discount->id }}" selected>{{ $discount->name }}</option>

                                </select>
                            </div>
                        </div>
                        <!-- // service -->
                        <!-- doctor -->
                        <div class="form-group row d-flex align-items-center" data-aos="fade-up">
                            <label for="bookDoctor" class="col-lg-3 col-form-label">{{ __('messages.doctor') }}</label>
                            <div class="col-lg-9">
                                <select class="custom-select" onchange="return showAvailableAppointments();" id="bookDoctor" name="doctor_id" required>
                                        <option value="">{{ __('messages.doctorrequired') }}</option>
                                        @if(!empty($doctors))
                                            @foreach($doctors as $doctor)
                                            <option value="{{ $doctor->id }}" {{ $request->doctor == $doctor->id ? 'selected' : '' }}>{{ $doctor->name }}</option>
                                            @endforeach
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
                                <input type="tel" class="form-control" id="bookPhone" onchange="validateContact(this)" maxlength="10" placeholder="{{ __('messages.phonerequired') }}" name="phone" value="{{ old('phone') }}" required>
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
                            <label for="bookTime" class="col-lg-3 col-form-label">{{ __('messages.Book Time') }}</label>
                            <div class="col-lg-9">
                                <select class="custom-select" id="bookTime" name="available_time" required>
                                    <option value="">{{ __('messages.timerequired') }}</option>
                                </select>
                                @if (request()->get('availability') == 1)
                                    <label for="bookTime" generated="true" class="error">{{ __('messages.Already Booked') }}</label>
                                @endif
                            </div>
                        </div>
                        <!-- // time -->
                        <!-- btn -->
                        <div class="row d-flex align-items-center">
                            <div class="col-lg-3"></div>
                            <div class="col-lg-9">
                                <button type="submit" class="btn btn-brand-primary btn-form" data-aos="fade-up">
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
                        <img src="{{ latest(settings()->get('book.image.page')) }}" draggable="false" alt="book now"
                            data-aos="zoom-out">
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

          updateServiceId(service_id);

        //  disablePastDates();

        })


        function disablePastDates() {
            $(function () {
                var dtToday = new Date();

                var month = dtToday.getMonth() + 1;
                var day = dtToday.getDate();
                var year = dtToday.getFullYear();
                if (month < 10)
                    month = '0' + month.toString();
                if (day < 10)
                    day = '0' + day.toString();

                var minDate = year + '-' + month + '-' + day;

                $('#bookDate').attr('min', minDate);
            });

        }

        function updateServiceId(btnId) {

            $(".services-nav span").removeClass("active");
            $("#services-"+ btnId +"").addClass("active");
            $("#ServiceId").val(btnId);
            service_id = $("#ServiceId").val();

        }

        function showDoctors() {

           service_id = $("#ServiceId").val();
           brancheId  = $("#bookBranch option:selected").val();

           if (service_id && brancheId) {

                $.ajax({
                    type: 'GET',
                    url: route('api.branches.doctors', {
                        'lang': '{{ app()->getLocale() }}',
                        'service': service_id,
                        'branche': brancheId
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
                    url: route('web.discount-booking.check.availability', {
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

