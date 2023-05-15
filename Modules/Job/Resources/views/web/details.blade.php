@extends('web.layouts.base')

@section('styles')
    <link rel="stylesheet" href="{{latest('/web/assets2/css/careers'.( (app()->getLocale() == 'ar') ? '-rtl' : '').'.min.css'}}" crossorigin="anonymous">

@endsection

@section('pageTitle')
{{ __("messages.Careers") }} | {{ $job->name }}
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
                {{ $job->name }}
            </h1>
            <!-- title -->
        </div>
    </div>
    <!-- // page header -->


    <!-- career details -->
    <section class="career-details d-pad">
        <div class="container">
            <!-- title -->
            <div class="title-container">
                <h2 class="title" data-aos="fade-up">
                    {{ $job->name }}
                </h2>
                <a href="{{ route('web.jobs.apply', app()->getLocale() == 'en' ? ['job' => $job->id ,'lang' => 'en'] : ['job' => $job->id ]) }}" class="btn btn-brand-primary" data-aos="fade-up">
                    {{ __("messages.Apply Now") }}
                </a>
            </div>
            <!-- // title -->
            <div class="careers__split">
                <!-- description -->
                <div class="careers__container" data-aos="fade-up">
                    <h3 class="h6">{{ __("messages.Job Description") }}:</h3>
                    {!! $job->description !!}
                </div>
                <!-- // description -->
                <!-- requirements -->
                <div class="careers__container" data-aos="fade-up">
                    <h3 class="h6">{{ __("messages.Job Requirements") }}:</h3>
                    {!! $job->requirements !!}
                </div>
                <!-- // requirements -->
            </div>
            <!-- apply now -->
            <div class="book-now">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-8 d-flex align-items-center">
                            <h2 class="h3" data-aos="fade-up">
                                {{ __("messages.Do you find yourself suitable for this position?") }}
                            </h2>
                        </div>
                        <div class="col-lg-4 d-flex align-items-center ">
                            <a href="{{ route('web.jobs.apply', app()->getLocale() == 'en' ? ['job' => $job->id ,'lang' => 'en'] : ['job' => $job->id ]) }}" class="btn btn-brand-white d-block w-100" data-aos="zoom-in">
                                {{ __("messages.Apply Now") }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- // apply now -->
        </div>
    </section>
    <!-- // career details -->
@endsection
@section('submit.scripts')

@endsection


