@extends('web.layouts.base')

@section('styles')
    <link rel="stylesheet preload" href="{{latest('/web/assets2/css/offers'. ((app()->getLocale() == 'ar') ? '-rtl' : '').'.min.css')}}" as="style" crossorigin>
@endsection

@section('pageTitle', __('messages.Offers'))

@section('metaKeys')
    {!! $settings['offer-cat.ceo'][app()->getLocale()] ?? '' !!}
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
                    <source srcset="{{latest($settings['offer.imagebg.page'][app()->getLocale()] ?? '') }}" type="image/webp">
                    <img src="{{ latest($settings['offer.imagebg.page'][app()->getLocale()] ?? '') }}" draggable="false" alt="page image" data-aos="zoom-out">
                </picture>
            </div>
            <!-- // image -->
            <!-- title -->
            <h1 class="h3" data-aos="fade-up" data-aos-delay="100">
                {{ $settings['titlesheader.offer.page'][app()->getLocale()] ?? '' }}
            </h1>
            <!-- title -->
        </div>
    </div>
    <!-- // page header -->


    <!-- offers -->
    <section class="offers d-pad">
        <div class="container">
            <!-- title -->
            <div class="section-title">
                {!! $settings['titlessection.offer.page'][app()->getLocale()] ?? '' !!}
            </div>
            <!-- // title -->
            <!-- offers -->
            <div class="offers__container" data-aos="fade-up" data-aos-delay="300">
                <!-- offer -->
                @if(!empty($offerbranches))
                    @foreach($offerbranches as $branches)
                    <a href="{{ route('web.offers.lists', app()->getLocale() == 'en' ? ['slug' => $branches->slug ,'lang' => 'en'] : ['slug' => $branches->slug]) }}" class="offer d-block">
                        <div class="offer__image" data-aos="zoom-out">
                            <picture>
                                <source srcset="{{ $branches->image }}" type="image/webp"><img src="{{ $branches->image }}"
                                    draggable="false" loading="lazy" alt="offer">
                            </picture>
                        </div>
                        <div class="offer__title">
                            <h3 class="h5">
                                <span class="overline d-block">{{ $branches->desc_offer ? $branches->desc_offer : '' }}</span>
                                {{ $branches->name ? $branches->name : '' }}
                            </h3>
                        </div>
                    </a>
                    @endforeach
                @endif
                <!-- // offer -->
            </div>
        </div>
    </section>
    <!-- // offers -->
@endsection
