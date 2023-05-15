@extends('web.layouts.base')

@section('styles')
    <link rel="stylesheet" href="{{latest('/web/assets2/css/careers'. ((app()->getLocale() == 'ar') ? '-rtl' : '').'.min.css')}}" crossorigin="anonymous">

@endsection

@section('pageTitle', __("messages.Careers"))

@section('slug')
    <li class="list-inline-item d-none d-xl-inline-block">
        <a href="{{ url(app()->getLocale() != 'ar' ? 'careers' : 'careers?lang=en') }}" class="lang">
            {{ app()->getLocale() != 'ar' ? __('messages.ar') : __('messages.en') }}
        </a>
    </li>
@endsection

@section('lang-mobile')
    <a href="{{ url(app()->getLocale() != 'ar' ? 'careers' : 'careers?lang=en') }}" class="d-xl-none lang">
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
                {{ __("messages.Careers") }}
            </h1>
            <!-- title -->
        </div>
    </div>
    <!-- // page header -->


    <!-- careers -->
    <section class="careers d-pad">
        <div class="container">
            <!-- Success Alert -->
            @if(session()->has('success'))
                <div class="row">
                    <div class="form-group col-md-7">
                        <div class="alert alert-success alert-dismissible fade show">
                            <strong style="margin: 8px;"> {{ (app()->getLocale() == 'ar') ? 'شكرا لك' : 'Thank You'}} </strong>  {{ (app()->getLocale() == 'ar') ? 'تم ارسال بياناتك بنجاح.' : 'Your data has been sent successfully.'}}
                            <button type="button" class="close ml-auto" data-dismiss="alert" aria-label="Close" @if(app()->getLocale() == 'ar') style="margin: -3px -23px 0px; float: left;" @else style="margin: -3px -23px 0px;" @endif>
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    </div>
                </div>
        @endif
        <!-- title -->
            <div class="section-title">
                <h2 class="title" data-aos="fade-up">
                    {{ __("messages.Available Jobs") }}
                </h2>
                <p data-aos="fade-up" data-aos-delay="100">
                    {{ __("messages.Join the medical staff, in need of Saudi and Arab expertise") }}
                </p>
            </div>
            <!-- // title -->
            <div class="careers__container">
                <!-- career -->
                <div class="career__row d-none d-lg-flex" data-aos="fade-up">
                    <span class="career__title d-block h6">{{ __("messages.Job") }}</span>
                    <span class="career__branch d-block h6">{{ __("messages.Branch") }}</span>
                    <span class="career__department d-block h6">{{ __("messages.Department") }}</span>
                    <span class="career__view d-block h6">{{ __("messages.View") }}</span>
                </div>
                <!-- // career -->
            @foreach($jobs as $job)
                <!-- career -->
                    <div class="career__row" data-aos="fade-up">
                    <span class="career__title d-block h6">
                        <a href="{{ route('web.jobs.details', app()->getLocale() == 'en' ? ['job' => $job->id , 'lang' => 'en'] : ['job' => $job->id]) }}">{{ $job->name }}</a>
                    </span>
                        <span class="career__branch d-block">{{ $job->branche->name }}</span>
                        <span class="career__department d-block">{{ $job->department->name }}</span>
                        <span class="career__view">
                        <a href="{{ route('web.jobs.details', app()->getLocale() == 'en' ? ['job' => $job->id , 'lang' => 'en'] : ['job' => $job->id]) }}" class="btn btn-brand-link">{{ __("messages.View") }}</a>
                    </span>
                    </div>
                    <!-- // career -->
                @endforeach
            </div>
            <!-- // article -->
            <!-- pagination -->
        {{ $jobs->appends(app()->getLocale() == 'en' ? ['lang' => 'en'] : '')->links('web.home.paginationv2') }}
        <!-- // pagination -->
        </div>
    </section>
    <!-- // careers -->


@endsection



