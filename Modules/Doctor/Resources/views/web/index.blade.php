@extends('web.layouts.base')

@section('styles')
    <link rel="stylesheet preload" href="{{latest('/web/assets2/css/doctors'.( (app()->getLocale() == 'ar') ? '-rtl' : '').'.min.css')}}" as="style" crossorigin>

@endsection

@section('pageTitle', $settings['metatitle.doctors'][app()->getLocale()] ??  __('messages.Ram Doctors'))

@section('metaKeys')
    {!! $settings['doctors.ceo'][app()->getLocale()] ?? '' !!}
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
                    <img src="{{latest('/web/assets/images/page-header.jpg')}}" draggable="false" alt="page image" data-aos="zoom-out">
                </picture>
            </div>
            <!-- // image -->
            <!-- title -->
            <h1 class="h3" data-aos="fade-up" data-aos-delay="100">
                {{ __('messages.Doctors') }}
            </h1>
            <!-- title -->
        </div>
    </div>
    <!-- // page header -->


    <!-- doctors -->
    <section class="doctors d-pad">
        <div class="container">
            <!-- title -->
            <div class="section-title">
                {!! $settings['docrots.about.page'][app()->getLocale()] ?? '' !!}
            </div>
            <!-- // title -->
            <div class="row">
                <!-- filters -->
                <div class="col-lg-4 col-xl-3">
                    <div class="filters">
                        <!-- search -->
                        <div class="filters__bg" data-aos="fade-up">
                            <div class="filter__search">
                                <form method="GET" action="{{ route('web.doctors.index', app()->getLocale() == 'en' ? ['lang' => 'en' ] : '') }}">
                                    <input type="search" name="q" class="form-control" placeholder="@if (request()->has('q')) {{ request()->get('q') }} @else {{ __("messages.Find a doctor") }} @endif">
                                    @if( app()->getLocale() != 'ar' )
                                        <input type="hidden" name="lang" value="{{ app()->getLocale() }}" />
                                    @endif
                                    <button type="submit" class="btn btn-brand-primary btn-icon">
                                        <span class="sr-only">{{ __('messages.search') }}</span>
                                        <svg>
                                            <use href="{{latest('/web/assets/images/icons/icons.svg#search')}}"></use>
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </div>
                        <!-- // search -->
                        <!-- filter -->
                        <input type="hidden" id="GetLocale" name="locale" class="form-control" value=" {{ app()->getLocale() == 'en' ? 'en' : 'ar' }}">
                        <div class="filters__bg" data-aos="fade-up">
                            <div class="filter__btns">
                                <div class="nav flex-column nav-pills">
                                    <button onClick="AllDictirs()" class="btn btn-white {{ $request->services == null ? 'active' : '' }}">{{ __('messages.all_doctors') }}</button>
                                    @if(!empty($servicesbar))
                                        @foreach($servicesbar as $service)
                                            <button onClick="showDoctorsByServices({{$service->id}})" class="btn btn-white {{ $request->services == $service->id ? 'active' : '' }}">{{ $service->name }}</button>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                        </div>

                        <input type="hidden" id="ServiceId" name="service" value="{{ request()->services ?? '' }}">

                        <!-- // filter -->
                        <!-- filter -->
                        <div class="filters__bg" data-aos="fade-up">
                            <div class="filter__select">
                                <form>
                                    <!-- branch -->
                                    <div class="form-group">
                                        <label class="sr-only" for="branchesFilter">@lang('messages.Branch filtering'):</label>
                                        <select id="branche" onchange="return showDoctors();" class="custom-select" name="branche" id="branchesFilter">
                                            <option value="">{{ __('messages.Branch filtering') }}</option>
                                            @if(!empty($countries))
                                                @foreach($countries as $cuntry)
                                                    <optgroup label="{{ $cuntry->name }}">
                                                        @foreach($cuntry->branche as $branch)
                                                            <option value="{{$branch->id}}" {{ $request->branche == $branch->id ? 'selected' : '' }}>{{ $branch->name }}</option>
                                                        @endforeach
                                                    </optgroup>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                    <!-- // branch -->
                                    <!-- services -->
                                    <div class="form-group">
                                        <label class="sr-only" for="servicesesFilter">{{ __('messages.services filtering') }}:</label>
                                        <select id="specialty"  onchange="return showDoctors();" class="custom-select" name="specialty" id="servicesesFilter">
                                            <option value="">{{ __('messages.services filtering') }}</option>
                                            @if(!empty($services))
                                                @foreach($services as $service)
                                                    <optgroup label="{{ $service->name }}">
                                                        @foreach($service->specialities as $special)
                                                            <option value="{{$special->id}}" {{ $request->specialty == $special->id ? 'selected' : '' }}>{{ $special->name }}</option>
                                                        @endforeach
                                                    </optgroup>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                    <!-- // services -->
                                </form>
                            </div>
                        </div>
                        <!-- // filter -->
                    </div>
                </div>
                <!-- // filters -->
                <!-- doctors -->
                <div class="col-lg-8 col-xl-9">
                    <div class="doctors__container">
                        <!-- doctor -->
                        @foreach($doctors as $doctor)
                            <div class="doctor">
                                <!-- img -->
                                <div class="doctor__image">
                                    <picture>
                                        <source srcset="{{ $doctor->image }}" type="image/webp">
                                        <img src="{{ $doctor->image }}" draggable="false" alt="{{ $doctor->alt_image ?  $doctor->alt_image : '' }}" data-aos="zoom-out">
                                    </picture>
                                </div>
                                <!-- // img -->
                                <!-- info -->
                                <div class="doctor__info" data-aos="fade-up">
                                    <h3 class="h5">{{ $doctor->name }}</h3>
                                    <span class="doctor__department color d-block">@if(app()->getLocale() == 'ar') رام @else Ram @endif {{ $doctor->service->name }}</span>
                                    <span class="doctor__branch d-block">{{ implode(' ، ' , $doctor->branches->pluck('name')->toArray()) }}</span>
                                </div>
                                <!-- // info -->
                                <!-- actions -->
                                <div class="doctor__actions d-flex justify-content-center" data-aos="fade-up" data-aos-delay="100">
                                    <a href="{{ url('book-an-appointment'. '/?doctor='. $doctor->id . '&service='. $doctor->service->id . ( app()->getLocale() != 'ar' ? ( '&lang=' . app()->getLocale()) : '')) }}" class="btn btn-brand-primary Booking_ads">
                                        {{ __('messages.Book Now') }}
                                        <svg class="btn-icon">
                                            <use href="{{latest('/web/assets/images/icons/icons.svg#book')}}"></use>
                                        </svg>
                                    </a>
                                    <a href="{{ route('web.doctors.details', app()->getLocale() == 'en' ? ['slug' => $doctor->slug ,'lang' => 'en'] : ['slug' => $doctor->slug ]) }}" class="btn btn-white">{{ __('messages.More') }}</a>
                                </div>
                                <!-- // actions -->
                            </div>
                        @endforeach
                    <!-- // doctor -->
                    </div>
                    <!-- pagination -->
                    {{ $doctors->appends(app()->getLocale() == 'en' ? ['lang' => 'en','services' => request()->get('services'),'specialty' => request()->get('specialty'),'branche' => request()->get('branche')] : ['services' => request()->get('services'),'specialty' => request()->get('specialty'),'branche' => request()->get('branche')])->links('web.home.paginationv2') }}
                <!-- // pagination -->
                </div>
                <!-- // doctors -->
            </div>
        </div>
    </section>
    <!-- // doctors -->
@endsection

@section('submit.scripts')
    <script type="text/javascript">

        function showDoctorsByServices(idservice) {
            specificityId = $("#specialty option:selected").val();
            brancheId =$("#branche option:selected").val();

            @if(app()->getLocale() == 'en')
                window.location.href = route('web.doctors.index', {'services' : idservice , 'specialty' : specificityId, 'branche' : brancheId , 'lang': '{{ app()->getLocale() }}'}) ;
            @else
                window.location.href = route('web.doctors.index', {'services' : idservice , 'specialty' : specificityId, 'branche' : brancheId }) ;
            @endif
        }

        function showDoctors() {
            specificityId = $("#specialty option:selected").val();
            brancheId =$("#branche option:selected").val();
            servicesId =$("#ServiceId").val();

            @if(app()->getLocale() == 'en')
                window.location.href = route('web.doctors.index', { 'services' : servicesId ,'specialty' : specificityId, 'branche' : brancheId , 'lang': '{{ app()->getLocale() }}'}) ;
            @else
                window.location.href = route('web.doctors.index', { 'services' : servicesId ,'specialty' : specificityId, 'branche' : brancheId }) ;
            @endif
        }

        function AllDictirs() {
            @if(app()->getLocale() == 'en')
                window.location.href = route('web.doctors.index', { 'lang': '{{ app()->getLocale() }}'}) ;
            @else
                window.location.href = route('web.doctors.index') ;
            @endif
        }
    </script>
@endsection
