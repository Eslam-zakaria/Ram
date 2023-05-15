@extends('web.layouts.base')

@section('styles')
    <link rel="stylesheet preload" href="/web/assets2/css/jcia-{{ direction(app()->getLocale()) }}.min.css" as="style" crossorigin>

@endsection

@section('content')
    <div class="relative page-cover d-flex align-items-center">
        <!-- photo -->
        <div class="page-cover__photo">
            <picture>
                <source srcset="{{ settings()->get('jcia.header.image') }}" type="image/webp"><img src="{{ settings()->get('jcia.header.image') }}" alt="al kahhal" draggable="false">
            </picture>
        </div>
        <!-- // photo -->
        <!-- content -->
        <div class="container">
            <div class="page-cover__content">
                <h2>{{ __('messages.JCIA') }}</h2>

            </div>
            <!-- support overlay -->
            @include('web.layouts.support')
            <!-- // support overlay -->
        </div>
        <!-- // content -->

    </div>
    <div class="jcia d-pad">
        <div class="container">
            <h2 class="title" data-aos="fade-up">
                {{ settings()->get('jcia.lead') }}
            </h2>
            <div class="row">
                <!-- left -->
                <div class="col-lg-6">
                    <!-- section -->
                    <div class="jcia__section" data-aos="fade-up">
                        <h3>{{ settings()->get('jcia.section.1.header') }}</h3>
                        <p>{!! nl2br(settings()->get('jcia.section.1.text'))  !!}</p>
                    </div>
                    <!-- // section -->


                    <!-- section -->
                    <div class="jcia__section" data-aos="fade-up">
                        <iframe width="100%" height="400" src="{{ settings()->get('jcia.video') }}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                    </div>
                    <!-- // section -->

                    <!-- section -->
                    <div class="jcia__section" data-aos="fade-up">
                        <h3>{{ settings()->get('jcia.section.2.header') }}</h3>
                        <p>{!! nl2br(settings()->get('jcia.section.2.text'))  !!}</p>
                    </div>
                    <!-- // section -->


                    <!-- photo -->
                    <div class="jcia-photo" data-aos="fade-up">
                        <picture>
                            <source srcset="{{ settings()->get('jcia.image.2') }}" type="image/webp"><img src="{{ settings()->get('jcia.image.2') }}" class="img-fluid" alt="jcia certificate">
                        </picture>
                    </div>
                </div>
                <!-- // left -->

                <!-- right -->
                <div class="col-lg-6">

                    <!-- photo -->
                    <div class="jcia-photo" data-aos="fade-up">
                        <picture>
                            <source srcset="{{ settings()->get('jcia.image') }}" type="image/webp"><img src="{{ settings()->get('jcia.image') }}" class="img-fluid" alt="jcia certificate">
                        </picture>
                    </div>
                    <!-- // photo -->
                    <!-- section -->
                    <div class="jcia__section" data-aos="fade-up">
                        <h3>{{ settings()->get('jcia.section.3.header') }}</h3>
                        <p>{!! nl2br(settings()->get('jcia.section.3.text'))  !!}</p>
                    </div>
                    <!-- // section -->
                </div>
                <!-- // right -->
                <div class="col-lg-12">
                    <!-- section -->
                    <div class="jcia__section" data-aos="fade-up">
                        <h3>{{ settings()->get('jcia.section.closure.header') }}</h3>
                        <p>{!!  nl2br(settings()->get('jcia.section.closure.text'))  !!}</p>
                    </div>
                    <!-- // section -->
                </div>
            </div>
        </div>
    </div>
@endsection
