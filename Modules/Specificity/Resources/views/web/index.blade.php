@extends('web.layouts.base')

@section('styles')
    <link rel="stylesheet preload" href="/web/assets2/css/specialties-{{ direction(app()->getLocale()) }}.min.css" as="style" crossorigin>
@endsection

@section('content')
    <div class="relative page-cover d-flex align-items-center">
        <!-- photo -->
        <div class="page-cover__photo">
            <picture>
                <source srcset="{{ settings()->get('specialty.image') }}" type="image/webp"><img src="{{ settings()->get('specialty.image') }}" alt="about al kahhal" draggable="false">
            </picture>
        </div>
        <!-- // photo -->
        <!-- content -->
        <div class="container">
            <div class="page-cover__content">
                <h2>{{ __('messages.Specialities') }}</h2>
                <p class="lead">{{ __('messages.Specialities Description') }}</p>
            </div>
            <!--   -->
                @include('web.layouts.support')
            <!-- //   -->
        </div>
        <!-- // content -->

    </div>

    <div class="specialties d-pad">
        <div class="container">
            <!-- tabs -->
            <div class="row">
                <div class="col-md-5 col-lg-4 col-xl-3">
                    <div class="nav nav-pills mb-6" id="v-pills-tab" role="tablist" aria-orientation="vertical" data-aos="fade-up" data-aos-delay="100">
                        <!-- tab -->
                        @foreach($categories as $category)
                            <a class="nav-link
                         @if($selectedSpeciality)
                            @if ($selectedSpeciality->category_id == $category->id)
                                 active
                            @endif
                          @else
                            {{ $loop->first ? 'active' : '' }}
                          @endif
                                "
                               id="spec-{{ $category->id }}-tab" data-toggle="pill" href="#spec-{{ $category->id }}" role="tab" aria-controls="spec-1" aria-selected="true">
                                {{ $category->name }}
                            </a>
                        @endforeach
                        <!-- // tab -->
                    </div>
                </div>
                <div class="col-md-7 col-lg-8 col-xl-9">
                    <div class="tab-content" id="v-pills-tabContent">
                        <!-- tab content -->

                        @foreach($categories as $category)
                            <div class="tab-pane fade
                                 @if($selectedSpeciality)
                                 @if ($selectedSpeciality->category_id == $category->id)
                                  show active
                                  @endif
                                @else
                                   {{ $loop->first ? 'show active' : '' }}
                                @endif
                                "
                                 id="spec-{{ $category->id }}" role="tabpanel" aria-labelledby="spec-{{ $category->id }}-tab">
                                <div class="row">
                                    <!-- department -->
                                    @foreach($category->enabledSpecialities as $speciality)
                                        <div class="col-lg-6 col-xl-4">
                                            <a href="javascript:;" onclick="return showContent({{ $speciality->id }})" class="spec-department " data-aos="fade-up">
                                                <div class="spec-department__icon">
                                                    <svg class="icon">
                                                        <use xlink:href="/web/assets/images/icons/kahhal-icons.svg#{{ $speciality->icon }}"></use>
                                                    </svg>
                                                </div>
                                                <div class="spec-department__text">
                                                    <h6>
	                                                    {{ $speciality->name }}
                                                    </h6>
                                                </div>
                                            </a>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- details tab -->
                <div class="col-lg-12">
                    <div class="specialties__text d-pad">
                        <div class="tab-content" id="details-tabContent">
                            <!-- spec content details -->
                            <div class="tab-pane fade show active" id="spec-1-details" role="tabpanel" aria-labelledby="spec-1-detail-btn">
                                <h3 id="service-name">
                                    {{ $selectedSpeciality ? $selectedSpeciality->name : '' }}
                                </h3>
                                <div class="pad">
                                    <p id="service-brief">
                                        {{ $selectedSpeciality ? $selectedSpeciality->brief : '' }}
                                    </p>

                                </div>
                                <h3>
                                    {{ __('messages.Speciality Services') }}
                                </h3>
                                <div class="row">
                                    <div class="col-lg-6" data-aos="fade-up">
                                        <div class="pad">
                                            <p id="service-content">
                                                {{ $selectedSpeciality ? $selectedSpeciality->description : '' }}
                                            </p>
                                        </div>
                                    </div>
                                    <!-- book -->
                                    <div class="col-lg-12">
                                        <a href="{{ route('web.booking.index', ['locale' => app()->getLocale()]) }}" class="btn btn-brand-arrow btn-square btn-lg" data-aos="fade-up">{{ __('messages.Book Now') }}</a>
                                    </div>
                                    <!-- // book -->
                                </div>
                            </div>
                            <!-- // spec content details -->
                        </div>
                    </div>
                </div>
                <!-- // details tab -->
            </div>
            <!-- // tabs -->
        </div>
    </div>

    <script type='text/javascript'>

        function showContent(id) {
            $.ajax({
                type: 'GET',
                url: route('api.specificities.show', { 'locale': '{{ app()->getLocale() }}', 'specificity' : id}),
                processData: false,
                contentType: false,
                success: function (data) {
                    $('#service-name').html(data.name);
                    $('#service-brief').html(data.brief);
                    $('#service-content').html(data.description);
                },
                error: function (data) {
                }
            });


        }
    </script>
@endsection
