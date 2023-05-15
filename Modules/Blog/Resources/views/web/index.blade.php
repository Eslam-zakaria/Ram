@extends('web.layouts.base')

@section('styles')
    <link rel="stylesheet" href="{{latest('/web/assets2/css/blog'.((app()->getLocale() == 'ar') ? '-rtl' : '').'.min.css')}}" crossorigin="anonymous">
@endsection

@section('pageTitle', $settings['metatitle.blogs'][app()->getLocale()] ?? __('messages.Ram Blog') )

@section('metaKeys')
    {!! $settings['blogs.ceo'][app()->getLocale()] ?? '' !!}
@endsection

@section('slug')
    <li class="list-inline-item d-none d-xl-inline-block">
        <a href="{{ url(app()->getLocale() != 'ar' ? 'blogs' : 'blogs?lang=en') }}" class="lang">
            {{ app()->getLocale() != 'ar' ? __('messages.ar') : __('messages.en') }}
        </a>
    </li>
@endsection

@section('lang-mobile')
    <a href="{{ url(app()->getLocale() != 'ar' ? 'blogs' : 'blogs?lang=en') }}" class="d-xl-none lang">
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
                    <source srcset="{{latest('/web/assets/images/page-header.webp')}}" type="image/webp" />
                    <img src="{{latest('/web/assets/images/page-header.jpg')}}" draggable="false" alt="page image" data-aos="zoom-out" />
                </picture>
            </div>
            <!-- // image -->
            <!-- title -->
            <h1 class="h3" data-aos="fade-up" data-aos-delay="100">@lang("messages.Ram Blog")</h1>
            <!-- title -->
        </div>
    </div>
    <!-- // page header -->

    <!-- blog -->
    <section class="blog d-pad">
        <div class="container">
            <!-- title -->
            <div class="section-title" data-aos="fade-up">{!! $settings['blog.index.description'][app()->getLocale()] ?? '' !!}</div>
            <!-- // title -->
            <!-- filters -->
            <div class="filters d-lg-flex justify-content-between">
                <!-- search -->
                <div class="filters__bg" data-aos="fade-up">
                    <div class="filter__search">
                        <form method="GET" action="{{ url('blogs') }}">

                            <input type="search" name="q" class="form-control" placeholder="@if (request()->has('q')) {{ request()->get('q') }} @else {{ __("messages.search") }} @endif">

                            @if( app()->getLocale() != 'ar' )
                                <input type="hidden" name="lang" value="{{ app()->getLocale() }}" />
                            @endif

                            <button type="submit" class="btn btn-brand-primary btn-icon">
                                <span class="sr-only">{{ (app()->getLocale() == 'ar') ? 'البحث' : 'Search'}}</span>
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
                    <div class="filter__select">
                        <form>
                            <div class="form-group">
                                <label class="sr-only" for="articlesFilter">{{ __("messages.Filter by Articles Type") }}:</label>
                                <select id="BlogByCat" class="form-control custom-select" onchange="return showBlogByCat();">
                                    <option value="">{{ __("messages.All Categories") }}</option>
                                    @foreach($categories as $category)
                                        <option value="{{  $category->id }}" @if(request()->get('category') == $category->id) selected @endif>{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- // filter -->
            </div>
            <!-- // filters -->
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
                                <a href="{{ url($article->category->slug ?? '') . ( app()->getLocale() != 'ar' ? '?lang=en' : '' ) }}" class="overline">
                                    {{ $article->category->name }}
                                </a>
                                <a href="{{ $article->blogDetailsLink }}">
                                    <h3 class="h5">{{ $article->name }}</h3>
                                    <p>
                                        <?php
                                            $brief = strip_tags($article->content);
                                            echo substr($brief, 0, 300) . " ...";
                                        ?>
                                    </p>
                                    <span class="date small">{{ \Carbon\Carbon::parse($article->created_at)->diffForHumans() }}</span>
                                </a>
                            </div>
                        </div>
                    </div>
                    <!-- // article -->
                @endif
            @endforeach
            <!-- pagination -->
            @if(app()->getLocale() == 'ar')
                {{ $articles->appends(app()->getLocale() == 'en' ? ['q' => request()->get('q') , 'category' => request()->get('category') ,'lang' => 'en'] : ['q' => request()->get('q') , 'category' => request()->get('category')])->links('web.home.paginationv2') }}
            @endif
            <!-- // pagination -->
            </div>
        </div>
    </section>
    <!-- // blog -->
@endsection

@section('submit.scripts')
    <script type="text/javascript">

        function showBlogByCat() {
            slugvalue = $("#BlogByCat option:selected").val();
            ReturnUrl = '{{ url("blogs") }}';

            if(slugvalue){
                @if(app()->getLocale() == 'en')
                    window.location.href = ReturnUrl + '?category=' + slugvalue + '&lang=en';
                @else
                    window.location.href = ReturnUrl + '?category=' + slugvalue ;
                @endif
            }
        }

    </script>
@endsection
