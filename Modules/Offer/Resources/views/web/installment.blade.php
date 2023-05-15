@extends('web.layouts.base')

@section('styles')
    <link rel="stylesheet preload" href="{{latest('/web/assets2/css/thanks'. ((app()->getLocale() == 'ar') ? '-rtl' : '').'.min.css')}}" as="style" crossorigin>
@endsection

@section('pageTitle')
    {{ (app()->getLocale() == 'ar') ? 'فشل فى عملية التقسيط' : 'Installment Failed'}}
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
                {{ (app()->getLocale() == 'ar') ? 'فشل فى عملية التقسيط' : 'Installment Failed'}}
            </h1>
            <!-- title -->
        </div>
    </div>
    <!-- // page header -->


    <!-- thanks -->
    <section class="thanks d-pad">
        <div class="container">
            <!-- title -->
            <div class="section-title">
                <h2 class="title" data-aos="fade-up">
                {{ (app()->getLocale() == 'ar') ? 'شكراً لك' : 'Thank You'}}،، <br>
                    <span class="color">{{ (app()->getLocale() == 'ar') ? 'لقد تلقينا خطأ فى عملية التقسيط يرجى التجربة مرة أخرى' : 'We received an error in the installment process, please try again'}}</span>
                </h2>
                <!-- <p class="lead" data-aos="fade-up" data-aos-delay="100">
                    إذا كنت تحتاج إلى نص ينوب عن محتوى لم يتم إنشائه بعد، يمكنك استخدام هذه الأداة. بهذه الطريقة، يصبح بإمكان مصممي
                    الرسومات ومطوري المواقع، الخ التركيز على العناصر الرئيسية الأخرى
                </p> -->
                <a href="{{ url(app()->getLocale() != 'ar' ? 'services?lang=en' : 'services') }}" class="btn btn-brand-primary" data-aos="fade-up" data-aos-delay="200">
                    {{ __('messages.View all services') }}
                </a>
                <a href="{{ route('web.home.index', app()->getLocale() == 'en' ? ['lang' => 'en' ] : '') }}" class="btn btn-brand-primary-5" data-aos="fade-up" data-aos-delay="200">
                    {{ __('messages.Home') }}
                </a>
            </div>
            <!-- // title -->
        </div>
    </section>
    <!-- // thanks -->
@endsection
