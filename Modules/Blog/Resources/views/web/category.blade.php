@extends('web.layouts.base')

@section('styles')
    <link rel="stylesheet" href="{{latest('/web/assets2/css/blog'.((app()->getLocale() == 'ar') ? '-rtl' : '').'.min.css')}}" crossorigin="anonymous">
@endsection

@section('pageTitle'){{ $articlecat->meta_title ? $articlecat->meta_title : $articlecat->name }}@endsection

@section('metaKeys')

    <meta property="og:title" content="{{ $articlecat->name ?? '' }}"/>
    <meta property="og:description" content="{{ $articlecat->meta_description ?? '' }}" />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="{{ url()->current() ?? '' }}"/>
    <meta property="og:image" content="{{ $articlecat->image ?? '/web/assets/images/logo.svg' }}"/>

    <!-- Meta description for twitter. -->
    <meta name="twitter:card" content="{{ $articlecat->image ?? '/web/assets/images/logo.svg' }}">
    <meta name="twitter:site" content="{{ url('/') }}">
    <meta name="twitter:title" content="{{ $articlecat->name ?? '' }}"/>
    <meta name="twitter:description" content="{{ $articlecat->meta_description ?? '' }}" />
    <meta name="twitter:image" content="{{ $articlecat->image ?? '/web/assets/images/logo.svg' }}" />

    <meta name="title" content="{{  $articlecat->meta_title ? $articlecat->meta_title : '' }}" />
    <meta name="description" content="{{  $articlecat->meta_description ? $articlecat->meta_keywords : '' }}" />
    <meta name="keywords" content="{{  $articlecat->meta_keywords  ? $articlecat->meta_keywords : ''}}" />
    <link rel="canonical" href="{{ $articlecat->canonical_url ? $articlecat->canonical_url : '' }}" />
@endsection

@section('slug')
    @if(app()->getLocale() == 'ar')
        <!-- <li class="list-inline-item d-none d-xl-inline-block">
            <a href="{{ url($articlecat->translate('en')->slug) . '?lang=en' }}" class="lang">English</a>
        </li> -->
    @else
        <li class="list-inline-item d-none d-xl-inline-block">
            <a href="{{ url($articlecat->translate('ar')->slug) }}" class="lang">عربي</a>
        </li>
    @endif
@endsection

@section('lang-mobile')
    @if(app()->getLocale() == 'ar')
        <!-- <a href="{{ url($articlecat->translate('en')->slug) . '?lang=en' }}" class="d-xl-none lang">English</a> -->
    @else
        <a href="{{ url($articlecat->translate('ar')->slug) }}" class="d-xl-none lang">عربي</a>
    @endif
@endsection

@section('content')

    <!-- page header -->
    <div class="page-header">
        <div class="container">
            <!-- image -->
            <div class="page-header__image">
                <picture>
                    <source srcset="{{latest('/web/assets/images/page-header.webp')}}" type="image/webp" />
                    <img src="{{latest('/web/assets/images/page-header.jpg')}}" draggable="false" alt="page image" data-aos="zoom-out" />
                </picture>
            </div>
            <!-- // image -->
            <!-- title -->
            <h1 class="h3" data-aos="fade-up" data-aos-delay="100">
                {{ __("messages.Ram Blog") }} {{ $articlecat->name ? $articlecat->name : '' }}
            </h1>
            <!-- title -->
        </div>
    </div>
    <!-- // page header -->


    <!-- blog -->
    <section class="blog d-pad">
        <div class="container">
            <!-- title -->
            <div class="section-title" data-aos="fade-up">
                <h2 class="title">
                    {!! __("messages.Latest Articles") !!} {{ (app()->getLocale() == 'ar') ? 'رام' : 'Ram'}} <span class="color"> {{ $articlecat->name ? $articlecat->name : '' }}</span>
                </h2>
            <!-- <p>
                   {{ __("messages.You will live a unique experience during") }}
                </p> -->
            </div>
            <!-- // title -->

            <div class="row">
            @foreach($articles as $article)
              @if(app()->getLocale() == 'ar')
                <!-- article -->
                    <div class="col-lg-6">
                        <div class="blog__article" data-aos="fade-up" data-aos-delay="100">
                            <a href="{{ $article->blogDetailsLink }}" class="d-block blog__article-photo">
                                <picture>
                                    <source srcset="{{ $article->image }}" type="image/webp" />
                                    <img src="{{ $article->image }}" draggable="false" loading="lazy" alt="{{ $article->alt_image ?  $article->alt_image : ''}}" />
                                </picture>
                            </a>

                            <div class="blog__article-info">
                                <a href="{{ url($article->category->slug) . ( app()->getLocale() != 'ar' ? '?lang=en' : '' ) }}" class="overline">{{ $article->category->name }}</a>
                                <a href="{{ $article->blogDetailsLink }}">
                                    <h3 class="h5">{{ $article->name }}</h3>
                                    <p>
                                        <?php
                                        $brief = strip_tags($article->content);
                                        echo substr($brief, 0, 300) . " ...";
                                        ?>                                </p>
                                    <span class="date small">
                                    {{ \Carbon\Carbon::parse($article->created_at)->diffForHumans() }}
                                </span>
                                </a>
                            </div>
                        </div>
                    </div>
                    @endif
            @endforeach
            <!-- // article -->
                <!-- pagination -->
            @if(app()->getLocale() == 'ar')
            {{ $articles->appends(app()->getLocale() == 'en' ? ['lang' => 'en'] : '')->links('web.home.paginationv2') }}
            @endif
            <!-- // pagination -->
            </div>
        </div>
    </section>
    <!-- // blog -->
@endsection
