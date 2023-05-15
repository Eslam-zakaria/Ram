@extends('web.layouts.base')

@section('styles')
    <link rel="stylesheet preload" href="{{latest('/web/assets2/css/article'. ((app()->getLocale() == 'ar') ? '-rtl' : '').'.min.css')}}" as="style" crossorigin>

@endsection

@section('pageTitle')
    {{ $article->meta_title ? $article->meta_title : $article->name }}
@endsection

@section('metaKeys')
    <meta property="og:title" content="{{ $article->name ?? '' }}"/>
    <meta property="og:description" content="{{ $article->meta_description ?? '' }}" />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="{{ url()->current() ?? '' }}"/>
    <meta property="og:image" content="{{ $article->image ?? '/web/assets/images/logo.svg' }}"/>

    <!-- Meta description for twitter. -->
    <meta name="twitter:card" content="{{ $article->image ?? '/web/assets/images/logo.svg' }}">
    <meta name="twitter:site" content="{{ url('/') }}">
    <meta name="twitter:title" content="{{ $article->name ?? '' }}"/>
    <meta name="twitter:description" content="{{ $article->meta_description ?? '' }}" />
    <meta name="twitter:image" content="{{ $article->image ?? '/web/assets/images/logo.svg' }}" />

    <meta name="title" content="{{  $article->meta_title ? $article->meta_title : '' }}" />
    <meta name="description" content="{{  $article->meta_description ? $article->meta_description : '' }}" />
    <meta name="keywords" content="{{  $article->meta_keywords  ? $article->meta_keywords : ''}}" />
    <link rel="canonical" href="{{ $article->canonical_url ? $article->canonical_url : '' }}" />
@endsection

@section('slug')
    @if(app()->getLocale() == 'ar')
        <!-- <li class="list-inline-item d-none d-xl-inline-block">
            @if(!empty($blogSlug->slug))
                <a href="{{ url($article->translate('en')->slug) . '?lang=en' }}" class="lang">
                    English
                </a>
            @endif
        </li> -->
    @else
        <li class="list-inline-item d-none d-xl-inline-block">
            <a href="{{ url($article->translate('ar')->slug) }}" class="lang">
                عربي
            </a>
        </li>
    @endif
@endsection

@section('lang-mobile')
    @if(app()->getLocale() == 'ar')
        @if(!empty($blogSlug->slug))
            <!-- <a href="{{ url($article->translate('en')->slug) . '?lang=en' }}" class="d-xl-none lang">
                English
            </a> -->
        @endif
    @else
        <a href="{{ url($article->translate('ar')->slug) }}" class="d-xl-none lang">عربي</a>
    @endif
@endsection

@section('content')
    <!-- page header -->
    <div class="page-header">
        <div class="container">
            <!-- image -->
            <div class="page-header__image">
                <picture>
                    <source srcset="{{ $article->image }}" type="image/webp" />
                    <img src="{{ $article->image }}" draggable="false" alt="{{ $article->alt_image ?  $article->alt_image : ''}}" data-aos="zoom-out" />
                </picture>
            </div>
            <!-- // image -->
            <!-- title -->
            <h1 class="h3" data-aos="fade-up" data-aos-delay="100">
                {{ $article->name }}
            </h1>
            <!-- title -->
        </div>
    </div>
    <!-- // page header -->

    <!-- article -->
    <section class="article d-pad">
        <div class="container">
            <div class="row">
                <!-- article content -->
                <div class="col-lg-7">
                    <!-- title -->
                    <div class="article-title" data-aos="fade-up">
                        <span class="overline">{{ $article->category->name }}</span>
                        <h2 class="title">{{ $article->name }}</h2>
                        <span class="date small">{{ \Carbon\Carbon::parse($article->created_at)->diffForHumans() }}</span>
                    </div>
                    <!-- // title -->
                    <!-- content -->
                    <div class="article__content">
                        <!-- image -->
                        <div class="article__image" data-aos="zoom-out">
                            <picture>
                                <source srcset="{{ $article->image }}" type="image/webp">
                                <img src="{{ $article->image }}" draggable="false" loading="lazy" alt="{{ $article->alt_image ?  $article->alt_image : ''}}">
                            </picture>
                        </div>
                        <!-- // image -->
                        {!! $article->content !!}
                    </div>
                    <!-- // content -->
                    <!-- add comment -->
                    <div class="article__block article__add-comment" data-aos="fade-up">
                        <h2 class="h4 article__section-title">{{ __("messages.Add your Comment") }}</h2>
                        <form method="POST" action="{{ route('web.advices.comment', app()->getLocale() == 'en' ? ['lang' => 'en'] : '') }}" class="article__form">
                            @csrf
                            <input type="hidden" name="blog_id" value="{{$article->id}}">
                            <input type="hidden" name="blog_slug" value="{{$article->slug}}">
                            <input type="hidden" name="lang" value="{{$app->getLocale()}}">

                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="commentName" class="sr-only">{{ __("messages.Full Name") }}</label>
                                    <input type="text" class="form-control" id="commentName" name="commenter" placeholder="{{ __("messages.Full Name") }}" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="commentEmail" class="sr-only">{{ __("messages.Email Address") }}</label>
                                    <input type="email" class="form-control" id="commentEmail" name="email" placeholder="{{ __("messages.Email Address") }}" required>
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="commentMessage" class="sr-only">{{ __("messages.Add your Comment") }}</label>
                                    <textarea class="form-control" id="commentMessage" name="content" placeholder="{{ __("messages.Add your Comment") }}.." required></textarea>
                                </div>
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-brand-primary">{{ __("messages.Add your Comment") }}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- // add comment -->
                    <!-- comments -->
                    @if(count($comments) > 0)
                    <div class="article__block article__comments" data-aos="fade-up">
                        <h2 class="h4 article__section-title">{{ __("messages.Comments") }}</h2>
                        @foreach($comments as $comment)
                        <!-- comment -->
                            <div class="article__comment" data-aos="fade-up">
                                <div class="article__comment-photo" data-aos="zoom-out">
                                    <picture>
                                        <source srcset="{{latest('/web/assets/images/user.webp')}}" type="image/webp">
                                        <img src="{{latest('/web/assets/images/user.jpg')}}" draggable="false" loading="lazy" alt="ram">
                                    </picture>
                                </div>
                                <div class="article__comment-text">
                                    <h3 class="h6">{{ $comment->commenter }}</h3>
                                    <span class="date small">
                                       {{ \Carbon\Carbon::parse($comment->created_at)->diffForHumans() }}
                                    </span>
                                    <p>
                                        {{ $comment->content }}
                                    </p>
                                </div>
                            </div>
                            <!-- // comment -->
                        @endforeach
                    </div>
                    @endif
                    <!-- // comments -->
                </div>
                <!-- // article content -->
                <!-- side -->
                <div class="col-lg-5">
                    <div class="article__side">
                        <!-- book now -->
                        <div class="article__side-block book-now">
                            <div class="container">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <h2 class="h4" data-aos="fade-up">
                                            {{ __('messages.Would you like') }}
                                        </h2>
                                    </div>
                                    <div class="col-lg-12">
                                        <a href="{{ url('book-an-appointment' . ( app()->getLocale() != 'ar' ? ( '/?lang=' . app()->getLocale() ) : '')) }}/" class="btn btn-brand-white Booking_ads" data-aos="fade-up" data-aos-delay="100">
                                            {{ __('messages.Book Now') }}
                                            <svg class="btn-icon">
                                                <use href="{{latest('/web/assets/images/icons/icons.svg#book')}}"></use>
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- // book now -->

                        <!-- opening and branches -->
                        <div class="article__side-block">
                             <!-- opening times -->
                             <div class="overlay-bg opening" data-aos="zoom-out-up">
                                <div class="overlay-bg__icon">
                                    <svg class="icon">
                                        <use href="{{latest('/web/assets/images/icons/icons.svg#dental')}}"></use>
                                    </svg>
                                </div>
                                {!! settings()->get('timework.home.page') !!}
                            </div>
                            <!-- // opening times -->
                            <!-- opening times -->
                            <div class="overlay-bg opening" data-aos="zoom-out-up">
                                <div class="overlay-bg__icon">
                                    <svg class="icon">
                                        <use href="{{latest('/web/assets/images/icons/icons.svg#derma')}}"></use>
                                    </svg>
                                </div>
                                {!! settings()->get('timework.derma.home.page') !!}
                            </div>
                            <!-- // opening times -->
                            <!-- opening times -->
                            <div class="overlay-bg opening" data-aos="zoom-out-up">
                                <div class="overlay-bg__icon">
                                    <svg class="icon">
                                        <use href="{{latest('/web/assets/images/icons/icons.svg#medical')}}"></use>
                                    </svg>
                                </div>
                                {!! settings()->get('timework.medical.home.page') !!}
                            </div>
                            <!-- // opening times -->
                            <!-- nearest branch -->
                            <div class="overlay-bg nearest-branch" data-toggle="modal" data-target="#nearestBranch" data-aos="zoom-out-up"
                                 data-aos-delay="100">
                                <div class=" overlay-bg__icon">
                                    <svg class="icon">
                                        <use href="{{latest('/web/assets/images/icons/icons.svg#location')}}"></use>
                                    </svg>
                                </div>
                                {!! settings()->get('briefbranches.home.page') !!}
                            </div>
                            <!-- // nearest branch -->
                        </div>
                        <!-- // opening and branches -->
                        <!-- nearest branch model -->
                        <div class="modal fade" id="nearestBranch" tabindex="-1" aria-labelledby="nearestBranchLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg modal-dialog-centered">
                                <div class="modal-content">
                                    <button type="button" class="close ml-auto" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    <div class="modal-header">
                                        <h4 class="modal-title" id="nearestBranchLabel">
                                            {{ __('messages.branch nearest') }}
                                        </h4>
                                    </div>
                                    <div class="modal-body">
                                        <form>
                                            <div class="form-group">
                                                <label>{{ __('messages.Choose service provided') }}:</label>
                                                <nav class="services-nav">
                                                    @if(!empty($services))
                                                        @foreach($services as $serv)
                                                            <span onclick="updateServiceId({{ $serv->id }})" id="services-{{ $serv->id }}" class="btn btn-brand-primary-5 {{ $loop->first ? 'active' : '' }}">
                                                            <svg class="icon">
                                                                <use href="{{latest('/web/assets/images/icons/icons.svg#'.$serv->icon)}}"></use>
                                                            </svg>
                                                            {{ $serv->name }}
                                                        </span>
                                                        @endforeach
                                                    @endif
                                                </nav>
                                            </div>
                                            <input type="hidden" id="ServiceId" name="service" value="1">
                                            <div class="form-group">
                                                <label for="nearestBranchSelect">{{ __('messages.branch nearest') }}:</label>
                                                <select class="custom-select" id="nearestBranchSelect" name="branche_id">
                                                    <option value="">{{ __('messages.Do you want choose') }}</option>
                                                    @if(!empty($countries))
                                                        @foreach($countries as $country)
                                                            <optgroup label="{{ $country->name }}">
                                                                @foreach($country->branche as $branch)
                                                                    <option value="{{ $branch->id }}">{{ $branch->name }}</option>
                                                                @endforeach
                                                            </optgroup>
                                                        @endforeach
                                                    @endif
                                                </select>
                                            </div>
                                            <div class="form-group text-center">
                                                <a onclick="return sendBook();" class="btn btn-brand-primary">
                                                    {{ __('messages.Book Now') }}
                                                    <svg class="btn-icon">
                                                        <use href="{{latest('/web/assets/images/icons/icons.svg#book')}}"></use>
                                                    </svg>
                                                </a>
                                                <a href="{{ route('web.branches.index', app()->getLocale() == 'en' ? ['lang' => 'en'] : '') }}" class="btn btn-white">
                                                    {{ __('messages.View all branches') }}
                                                </a>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- // nearest branch model -->

                        <!-- newsletter -->
                        <div class="article__side-block article__subscribe" data-aos="fade-up">
                            <div class="footer__form">
                                <h6>{{ __('messages.Subscribe now') }}:</h6>
                                <form method="POST" action="{{ route('web.home.subscribe', app()->getLocale() == 'en' ? ['lang' => 'en'] : '') }}">
                                    @csrf
                                    <div class="form-group">
                                        <label for="subscribeNewsletter" class="sr-only">{{ (app()->getLocale() == 'ar') ? 'أدخل رقم الجوال' : 'Enter the mobile number'}}</label>
                                        <span class="form-icon">
                                            <svg class="icon">
                                                <use href="{{latest('/web/assets/images/icons/icons.svg#iphone')}}"></use>
                                            </svg>
                                        </span>
                                        <input type="tel" name="phone" class="form-control" onchange="validateContact(this)" maxlength="10" placeholder="{{ (app()->getLocale() == 'ar') ? 'أدخل رقم الجوال' : 'Enter the mobile number'}}" id="subscribeNewsletter" required>
                                        <button class="btn btn-brand-primary">{{ (app()->getLocale() == 'ar') ? 'إشترك' : 'Subscribe'}}</button>
                                        <div class="invalid-feedback">
                                            {{ (app()->getLocale() == 'ar') ? 'يجب أن يكون هذا الحقل جوالًا سعوديًا (05xxxxxxxx).' : 'This field must be saudi arabia mobile (05xxxxxxxx).'}}
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!-- // newsletter -->

                        <!-- rekated articles -->
                        <div class="article__side-block article__related">
                            <div class="footer__form" data-aos="fade-up">
                                <h3 class="h5">{{ (app()->getLocale() == 'ar') ? 'مقالات ذات صلة' : 'Related Articles'}}</h3>
                                @foreach($relatedArticles as $relatedArticle)
                                <!-- article -->
                                    <div class="blog__article" data-aos="fade-up" data-aos-delay="100">
                                        <a href="{{ $relatedArticle->blogDetailsLink }}" class="d-block blog__article-photo">
                                            <picture>
                                                <source srcset="{{ $relatedArticle->image }}" type="image/webp" />
                                                <img src="{{ $relatedArticle->image }}" draggable="false" loading="lazy" alt="alt" />
                                            </picture>
                                        </a>
                                        <div class="blog__article-info">
                                            <a href="{{ url($relatedArticle->category->slug) . ( app()->getLocale() != 'ar' ? '?lang=en' : '' ) }}" class="overline">{{ $relatedArticle->category->name }}</a>
                                            <a href="{{ $relatedArticle->blogDetailsLink }}">
                                            <h3 class="h5">{{ $relatedArticle->name }}</h3>
                                                <p>
                                                    <?php
                                                    $brief = strip_tags($relatedArticle->content);
                                                    echo substr($brief, 0, 300) . " ...";
                                                    ?>
                                                </p>
                                                <span class="date small">
                                                    {{ \Carbon\Carbon::parse($relatedArticle->created_at)->diffForHumans() }}
                                                </span>
                                            </a>
                                        </div>
                                    </div>
                                    <!-- // article -->
                                @endforeach
                            </div>
                        </div>
                        <!-- // rekated articles -->
                    </div>
                </div>
                <!-- side -->
            </div>
        </div>
    </section>
    <!-- // article -->
@endsection

@section('submit.scripts')
    <script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.9/jquery.validate.js"></script>
    <script type="text/javascript">

        $(document).ready(function () {
            service_id = $("#ServiceId").val();
            $("#services-"+ service_id +"").addClass("active");
            $("#ServiceId").val(service_id);

            updateServiceId(service_id);

        })

        function updateServiceId(btnId) {

            $(".services-nav span").removeClass("active");
            $("#services-"+ btnId +"").addClass("active");
            $("#ServiceId").val(btnId);
            service_id = $("#ServiceId").val();

            var select = $("#nearestBranchSelect");
            select.empty();
            var content = '<option value="">{{ __('messages.Do you want choose') }}</option>';
            select.append(content);

            if (service_id) {
                $.ajax({
                    type: 'GET',
                    url: route('api.branches.services', {
                        'lang': '{{ app()->getLocale() }}',
                        'service': service_id
                    }),
                    processData: false,
                    contentType: false,
                    success: function (data) {
                        var select = $("#nearestBranchSelect");
                        select.empty();
                        var content = '<option value="">{{ __('messages.Do you want choose') }}</option>';
                        select.append(content);
                        $.each(data.countries, function (index, country) {
                            if(data.branches.length > 0){
                                select.append('<optgroup label="' + country.name + '">');
                            }
                            $.each(data.branches, function (index, branche) {
                                if(country.id == branche.country_id) {
                                    var content = '<option value="' + branche.id + '">' + branche.name + '</option>';
                                    select.append(content);
                                }
                            });
                            if(data.branches.length > 0){
                                select.append('</optgroup>');
                            }
                        });

                    },
                    error: function (data) {
                    }
                });

            }
        }

        function sendBook() {

            service_id = $("#ServiceId").val();
            brancheId  = $("#nearestBranchSelect option:selected").val();

            @if(app()->getLocale() == 'en')
            window.location.href = "/book-an-appointment" + '?service=' + service_id  + '&branche=' + brancheId + '&lang=' + 'en' ;
            @else
            window.location.href = "/book-an-appointment" + '?service=' + service_id  + '&branche=' + brancheId ;
            @endif
        }

    </script>
    <script type='text/javascript'>

        function validateContact(tel) {

            var xyz=document.getElementById('subscribeNewsletter').value.trim();

            var  phoneno = /^\d{10}$/;
            if((tel.value.match(phoneno)) && tel.value.length == 10 && xyz.substr(0,2)==='05' && $.isNumeric(xyz))
            {
                $(tel).removeClass('is-invalid');
                $(tel).addClass('is-valid');

            }
            else
            {
                $("#subscribeNewsletter").val('');
                $(tel).removeClass('is-valid');
                $(tel).addClass('is-invalid');

            }
        }

    </script>
@endsection
