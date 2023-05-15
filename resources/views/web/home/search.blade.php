@extends('web.layouts.base')

@section('styles')
    <link rel="stylesheet preload" href="{{latest('/web/assets2/css/search'.((app()->getLocale() == 'ar') ? '-rtl' : '').'.min.css')}}" as="style" crossorigin>
@endsection

@section('pageTitle', __('messages.search_results_for') . ' ' . ( $request->keyword ?? '') )

@section('styles')
    <link rel="stylesheet" href="{{latest('/web/assets2/css/home'.((app()->getLocale() == 'ar') ? '-rtl' : '').'.min.css')}}" crossorigin="anonymous">
@endsection

@push('styles')
    <style>
        .spinner {
            width: 40px;
            height: 40px;

            position: relative;
            margin: 100px auto;
        }

        .double-bounce1, .double-bounce2 {
            width: 100%;
            height: 100%;
            border-radius: 50%;
            background-color: #333;
            opacity: 0.6;
            position: absolute;
            top: 0;
            left: 0;

            -webkit-animation: sk-bounce 2.0s infinite ease-in-out;
            animation: sk-bounce 2.0s infinite ease-in-out;
        }

        .double-bounce2 {
            -webkit-animation-delay: -1.0s;
            animation-delay: -1.0s;
        }

        @-webkit-keyframes sk-bounce {
            0%, 100% { -webkit-transform: scale(0.0) }
            50% { -webkit-transform: scale(1.0) }
        }

        @keyframes sk-bounce {
            0%, 100% {
                transform: scale(0.0);
                -webkit-transform: scale(0.0);
            } 50% {
                  transform: scale(1.0);
                  -webkit-transform: scale(1.0);
              }
        }
    </style>
@endpush

@section('slug')
    @if(app()->getLocale() == 'ar')
        <li class="list-inline-item d-none d-xl-inline-block">
            <a href="{{ route('web.home.index', ['lang' =>'en' ]) }}" class="lang">
                English
            </a>
        </li>
    @else
        <li class="list-inline-item d-none d-xl-inline-block">
            <a href="{{ route('web.home.index') }}" class="lang">
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
                    <source srcset="{{latest('/web/assets2/images/page-header.webp')}}" type="image/webp">
                    <img src="{{latest('/web/assets2/images/page-header.jpg')}}" draggable="false" alt="page image" data-aos="zoom-out">
                </picture>
            </div>
            <!-- // image -->

            <!-- title -->
            <h1 class="h3" data-aos="fade-up" data-aos-delay="100">
                @lang('messages.search_results_for')  {{ request()->keyword ?? '' }}
            </h1>
            <!-- title -->
        </div>
    </div>
    <!-- // page header -->

    <!-- search -->
    <section class="search d-pad">
        <div class="container">
            <!-- title -->
            <div id="no_results" class="d-flex flex-column align-items-center" style="display: none !important;">
                <h3 class="mb-3">@lang('messages.no_results_found')</h3>
                <h6 class="text-center">@lang('messages.no_searches')</h6>
            </div>

            <div id="list_articles">
                <div class="section-title">
                    <small class="color"> <span class="articles_search_count">  </span> @lang('messages.search_result') @lang('messages.articles') </small>
                    <h2 class="title" data-aos="fade-up">
                        @lang('messages.search_result')
                        @lang('messages.articles')
                    </h2>
                </div>
                <!-- // title -->
                <div class="search__container" id="articles_section">
                    <div class="spinner" id="spinner_articles_section">
                        <div class="double-bounce1"></div>
                        <div class="double-bounce2"></div>
                    </div>
                </div>

                <div class="text-center mt-5 mb-5">
                    <button class="btn btn-brand-primary d-none"
                            id="btn_more_articles"
                            data-link="{{ route('api.blogs.list') }}">@lang('messages.see_more')</button>
                </div>
            </div>

            <div id="list_doctors">
                <div class="section-title">
                    <small class="color"> <span class="doctors_search_count">  </span> @lang('messages.search_result') @lang('messages.Doctors') </small>
                    <h2 class="title" data-aos="fade-up">
                        @lang('messages.search_result')
                        @lang('messages.Doctors')
                    </h2>
                </div>
                <!-- // title -->
                <div class="search__container" id="doctors_section">
                    <div class="spinner" id="spinner_doctors_section">
                        <div class="double-bounce1"></div>
                        <div class="double-bounce2"></div>
                    </div>
                </div>

                <div class="text-center mt-5 mb-5">
                    <button class="btn btn-brand-primary d-none"
                            id="btn_more_doctors"
                            data-link="{{ route('api.doctors.list') }}">@lang('messages.see_more')</button>
                </div>
            </div>

            <div id="list_specificities">
                <div class="section-title">
                    <small class="color"> <span class="specificities_search_count">  </span> @lang('messages.search_result') @lang('messages.Services') </small>
                    <h2 class="title" data-aos="fade-up">
                        @lang('messages.search_result')
                        @lang('messages.Services')
                    </h2>
                </div>
                <!-- // title -->
                <div class="search__container" id="specificities_section">
                    <div class="spinner" id="spinner_specificities_section">
                        <div class="double-bounce1"></div>
                        <div class="double-bounce2"></div>
                    </div>
                </div>

                <div class="text-center mt-5 mb-5">
                    <button class="btn btn-brand-primary d-none"
                            id="btn_more_specificities"
                            data-link="{{ route('api.specificities.list') }}">@lang('messages.see_more')</button>
                </div>
            </div>
        </div>
    </section>
    <!-- // search -->
@stop

@push('js')
    <!-- BEGIN :: script for articles -->
    <script>
        $(window).on('load', function(){
            $('#spinner_articles_section').addClass('d-none')

            let article = getArticles($('#btn_more_articles').data('link'))

            $('#spinner_doctors_section').addClass('d-none')

            let doctors = getDoctors($('#btn_more_doctors').data('link'))

            $('#spinner_specificities_section').addClass('d-none')

            let specificities = getSpecificities($('#btn_more_specificities').data('link'))

            if(article &&  doctors && specificities){

                $('#no_results').removeAttr("style");
            }
        });

        $(document).on('click', '#btn_more_articles', function(){

            getArticles($('#btn_more_articles').data('link'))
        });

        var APP_URL = {!! json_encode(url('/')) !!};

        function getArticles(url) {

            var data_value = false;

            $.ajax({
                url: url.replace(/^http:/, 'https:'),
                //url: url,
                type: 'GET',
                async: false,
                data: {
                    'lang': '{{ app()->getLocale() }}',
                    'keyword': '{{ request()->keyword }}'
                },
                success: function(response) {

                    if( response.total == 0 )
                        $('#list_articles').addClass('d-none')

                    $('.articles_search_count').text(response.total)

                    if( response.next_page_url != null ){
                        $('#btn_more_articles').removeClass('d-none')
                    }else{
                        $('#btn_more_articles').addClass('d-none')
                    }

                    data_value = ( response.data.length === 0 );

                    $('#btn_more_articles').data('link', response.next_page_url);

                    $.each(response.data, function( index, value ) {
                        @if(app()->getLocale() == 'en')
                            ReturnUrl = value.slug + '&lang=en';
                        @else
                            ReturnUrl = value.slug;
                        @endif
                        let $element =
                            '<a href="' + APP_URL + '/' + ReturnUrl + '" class="search__result" data-aos="fade-up"> \n'+
                                '<div class="search__result-image"> \n'+
                                    '<picture> \n'+
                                        '<source srcset="'+ value.image +'" type="image/webp"> \n'+
                                        '<img src="'+ value.image +'" draggable="false" loading="lazy" alt="blog"> \n'+
                                    '</picture> \n'+
                                '</div> \n'+
                                '<div class="search__result-text"> \n'+
                                    '<span class="color small">@lang('messages.articles')</span> \n'+
                                    '<h3 class="h6">'+ value.name +'</h3> \n'+
                                    '<p>'+ value.content.substring(0, 250).replace(/(<([^>]+)>)/gi, "") +'</p> \n'+
                                '</div> \n'+
                            '</a>';

                        $('#articles_section').append($element);
                    });
                },
                error : function(request,error)
                {
                    alert("Request: "+JSON.stringify(request));
                }
            });

            return data_value;
        }

        $(document).on('click', '#btn_more_doctors', function(){

            getDoctors($('#btn_more_doctors').data('link'))
        });

        function getDoctors(url) {

            var doctors_value = false;

            $.ajax({
                url: url.replace(/^http:/, 'https:'),
                //url: url,
                type: 'GET',
                async: false,
                data: {
                    'lang': '{{ app()->getLocale() }}',
                    'keyword': '{{ request()->keyword }}'
                },
                success: function(response) {

                    if( response.total == 0 )
                        $('#list_doctors').addClass('d-none')

                    $('.doctors_search_count').text(response.total)

                    if( response.next_page_url != null ){
                        $('#btn_more_doctors').removeClass('d-none')
                    }else{
                        $('#btn_more_doctors').addClass('d-none')
                    }

                    $('#btn_more_doctors').data('link', response.next_page_url);

                    doctors_value = ( response.data.length === 0 );

                    $.each(response.data, function( index, value ) {

                        @if(app()->getLocale() == 'en')
                            ReturnUrl = route('web.doctors.details', {'slug' : value.slug , 'lang': '{{ app()->getLocale() }}'}) ;
                        @else
                            ReturnUrl = route('web.doctors.details', {'slug' : value.slug  }) ;
                        @endif

                        let $element =
                            '<a href="'+ ReturnUrl +'" class="search__result" data-aos="fade-up"> \n'+
                                '<div class="search__result-image"> \n'+
                                    '<picture> \n'+
                                        '<source srcset="'+ value.image +'" type="image/webp"> \n'+
                                        '<img src="'+ value.image +'" draggable="false" loading="lazy" alt="doctor"> \n'+
                                    '</picture> \n'+
                                '</div> \n'+
                                '<div class="search__result-text"> \n'+
                                    '<span class="color small">@lang('messages.Doctors')</span> \n'+
                                    '<h3 class="h6">'+ value.name +'</h3> \n'+
                                    '<p>'+ value.description.substring(0, 250).replace(/(<([^>]+)>)/gi, "") +'</p> \n'+
                                '</div> \n'+
                            '</a>';

                        $('#doctors_section').append($element);
                    });
                },
                error : function(request,error)
                {
                    alert("Request: "+JSON.stringify(request));
                }
            });

            return doctors_value;
        }

        $(document).on('click', '#btn_more_specificities', function(){

            getSpecificities($('#btn_more_specificities').data('link'))
        });

        function getSpecificities(url) {

            var data_value = false;

            $.ajax({
                url: url.replace(/^http:/, 'https:'),
                //url: url,
                type: 'GET',
                async: false,
                data: {
                    'lang': '{{ app()->getLocale() }}',
                    'keyword': '{{ request()->keyword }}'
                },
                success: function(response) {

                    if( response.total == 0 )
                        $('#list_specificities').addClass('d-none')

                    $('.specificities_search_count').text(response.total)

                    if( response.next_page_url != null ){
                        $('#btn_more_specificities').removeClass('d-none')
                    }else{
                        $('#btn_more_specificities').addClass('d-none')
                    }

                    $('#btn_more_specificities').data('link', response.next_page_url);

                    data_value = ( response.data.length === 0 );

                    $.each(response.data, function( index, value ) {

                        let $element =
                            '<a href="#!" class="search__result" data-aos="fade-up"> \n'+
                                '<div class="search__result-image"> \n'+
                                    '<picture> \n'+
                                        '<source srcset="'+ value.image +'" type="image/webp"> \n'+
                                        '<img src="'+ value.image +'" draggable="false" loading="lazy" alt="service"> \n'+
                                    '</picture> \n'+
                                '</div> \n'+
                                '<div class="search__result-text"> \n'+
                                    '<span class="color small">@lang('messages.Services')</span> \n'+
                                    '<h3 class="h6">'+ value.name +'</h3> \n'+
                                    '<p>'+ value.description.substring(0, 250).replace(/(<([^>]+)>)/gi, "") +'</p> \n'+
                                '</div> \n'+
                            '</a>';

                        $('#specificities_section').append($element);
                    });
                },
                error : function(request,error)
                {
                    alert("Request: "+JSON.stringify(request));
                }
            });

            return data_value;
        }
    </script>
    <!-- END :: script for specificities -->
@endpush
