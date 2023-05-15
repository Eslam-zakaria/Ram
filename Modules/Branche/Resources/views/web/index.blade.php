@extends('web.layouts.base')

@section('styles')
    <link rel="stylesheet preload" href="{{latest('/web/assets2/css/branches'.((app()->getLocale() == 'ar') ? '-rtl' : '').'.min.css')}}" as="style" crossorigin>
@endsection

@section('metaKeys')
    {!! $settings['branches.seo'][app()->getLocale()] ?? '' !!}
@endsection

@section('pageTitle', __('messages.Our Branches'))

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
                {{ __('messages.Branches') }}
            </h1>
            <!-- title -->
        </div>
    </div>
    <!-- // page header -->


    <!-- branches -->
    <section class="branches d-pad">
        <div class="container">
            <!-- title -->
            <div class="section-title">
                {!! settings()->get('branches.about.page') !!}
            </div>
            <!-- // title -->
            <div class="row">
                <!-- filters -->
                <div class="col-lg-4 col-xl-3">
                    <div class="filters">
                        <!-- search -->
                        <div class="filters__bg" data-aos="fade-up">
                            <div class="filter__search">
                                <form method="GET" action="{{ route('web.branches.index', app()->getLocale() == 'en' ? ['lang' => 'en' ] : '') }}">
                                    <input type="search" name="q" value="{{ $request->q }}" class="form-control" placeholder="{{ __('messages.Search in branches') }}">
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
                        <div class="filters__bg" data-aos="fade-up">
                            <div class="filter__btns">
                                <div class="nav flex-column nav-pills">
                                    <button onClick="AllDictirs()" class="btn btn-white {{ $request->services == null ? 'active' : '' }}">{{ __('messages.View all branches') }}</button>
                                    @if(!empty($servicesbar))
                                        @foreach($servicesbar as $service)
                                            <button onClick="showBranchesByServices({{$service->id}})" class="btn btn-white {{ $request->services == $service->id ? 'active' : '' }}">{{ $service->name }}</button>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                        </div>
                        <!-- // filter -->
                        <!-- filter -->
                        <div class="filters__bg" data-aos="fade-up">
                            <div class="filter__select">
                                <form>
                                    <!-- branch -->
                                    <div class="form-group">
                                        <label class="sr-only" for="branchesFilter">{{ __('messages.Branch filtering') }}:</label>
                                        <select id="branche" onchange="return showBranches();" class="custom-select" name="branche" id="branchesFilter">
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
                                <!-- <div class="form-group">
                                        <label class="sr-only" for="servicesesFilter">{{ __('messages.services filtering') }}:</label>
                                        <select id="specialty"  onchange="return showBranches();" class="custom-select" name="specialty" id="servicesesFilter">
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
                                </div> -->
                                    <!-- // services -->
                                </form>
                            </div>
                        </div>
                        <!-- // filter -->
                    </div>
                </div>
                <!-- // filters -->
                <!-- branches -->
                <div class="col-lg-8 col-xl-9">
                    <div class="branches__container">
                        <!-- branch -->
                        @foreach($branches as $branche)
                            <div class="branch" data-aos="fade-up">
                                <div class="branch__image" data-aos="zoom-out" data-aos-delay="100">
                                    <picture>
                                        <source srcset="{{ $branche->image }}" type="image/webp">
                                        <img src="{{ $branche->image }}" draggable="false" loading="lazy" alt="branch">
                                    </picture>
                                </div>
                                <div class="branch__info">
                                    <h3 class="h6">{{ $branche->name }}</h3>
                                    <span class="color">@if(app()->getLocale() == 'ar') رام @else Ram @endif {{ implode(' ، ' , $branche->services->pluck('name')->toArray()) }}</span>
                                    <p>{{ $branche->country->name }}</p>
                                </div>
                                <div class="branch__btns d-flex">
                                    <a href="{{ $branche->location }}" target="_blank" class="btn btn-brand-white">{{ __('messages.Location') }}</a>
                                    <a href="tel:{{ $branche->phone }}" class="btn btn-brand-white">{{ __('messages.Contact the branch') }}</a>
                                    <a href="{{ url('book-an-appointment'. '/?branche='. $branche->id . ( app()->getLocale() != 'ar' ? ( '&lang=' . app()->getLocale()) : '')) }}" class="btn btn-brand-primary Booking_ads">{{ __('messages.Book Now') }}</a>
                                </div>
                            </div>
                    @endforeach
                    <!-- // branch -->
                    </div>
                    <!-- pagination -->
                {{ $branches->appends(app()->getLocale() == 'en' ? ['services' => request()->get('services') , 'branche' => request()->get('branche') ,'lang' => 'en'] : ['services' => request()->get('services') , 'branche' => request()->get('branche')])->links('web.home.paginationv2') }}
                <!-- // pagination -->
                </div>
                <!-- // branches -->
            </div>
        </div>
    </section>
    <!-- // branches -->
@endsection

@section('submit.scripts')
    <script type="text/javascript">
        function showBranches() {
            specificityId = $("#specialty option:selected").val();
            brancheId =$("#branche option:selected").val();
            @if(app()->getLocale() == 'en')
                window.location.href = route('web.branches.index', {'specialty' : specificityId, 'branche' : brancheId ,'lang': '{{ app()->getLocale() }}'}) ;
            @else
                window.location.href = route('web.branches.index', {'specialty' : specificityId, 'branche' : brancheId}) ;
            @endif
        }

        function showBranchesByServices(idservice) {
            @if(app()->getLocale() == 'en')
                window.location.href = route('web.branches.index', {'services' : idservice ,'lang': '{{ app()->getLocale() }}'}) ;
            @else
                window.location.href = route('web.branches.index', {'services' : idservice}) ;
            @endif
        }

        function AllDictirs() {
            @if(app()->getLocale() == 'en')
                window.location.href = route('web.branches.index', { 'lang': '{{ app()->getLocale() }}'}) ;
            @else
                window.location.href = route('web.branches.index', { 'lang': '{{ app()->getLocale() }}'}) ;
            @endif
        }
    </script>
@endsection
