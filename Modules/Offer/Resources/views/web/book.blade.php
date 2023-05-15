@extends('web.layouts.base')

@section('styles')
    <link rel="stylesheet preload" href="{{latest('/web/assets2/css/offers'. ((app()->getLocale() == 'ar') ? '-rtl' : '').'.min.css') }}" as="style" crossorigin>
@endsection

@section('pageTitle')
{{ __('messages.Latest Offers') }} | {{ $offer->name ? $offer->name : '' }}
@endsection

@section('metaKeys')
    <meta property="og:title" content="{{ $offer->name ?? '' }}"/>
    <meta property="og:description" content="{{ $offer->meta_description ?? '' }}" />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="{{ url()->current() ?? '' }}"/>
    <meta property="og:image" content="{{ $offer->image ?? '/web/assets/images/logo.svg' }}"/>

    <!-- Meta description for twitter. -->
    <meta name="twitter:card" content="{{ $offer->image ?? '/web/assets/images/logo.svg' }}">
    <meta name="twitter:site" content="{{ url('/') }}">
    <meta name="twitter:title" content="{{ $offer->name ?? '' }}"/>
    <meta name="twitter:description" content="{{ $offer->meta_description ?? '' }}" />
    <meta name="twitter:image" content="{{ $offer->image ?? '/web/assets/images/logo.svg' }}" />

    <meta name="title" content="{{ $offer->meta_title ?? '' }}"/>
    <meta name="description" content="{{ $offer->meta_description ?? '' }}"/>
    <meta name="keywords" content="{{ $offer->meta_keywords ?? '' }}"/>
    <link rel="canonical" href="{{ $offer->canonical_url ?? '' }}" />

@endsection

@section('slug')
@if(app()->getLocale() == 'ar')
<li class="list-inline-item d-none d-xl-inline-block">
    <a href="{{ route(Route::currentRouteName(), array_replace(Route::getCurrentRoute()->parameters(), ['lang' =>'en' ,'id' => $offer->id])) }}" class="lang">
        English
    </a>
</li>
@else
<li class="list-inline-item d-none d-xl-inline-block">
    <a href="{{ route(Route::currentRouteName(), array_replace(Route::getCurrentRoute()->parameters(), ['id' => $offer->id])) }}" class="lang">
        عربي
    </a>
</li>
@endif
@endsection

@section('lang-mobile')
@if(app()->getLocale() == 'ar')
<a href="{{ route(Route::currentRouteName(), array_replace(Route::getCurrentRoute()->parameters(), ['lang' =>'en' ,'id' => $offer->id])) }}" class="d-xl-none lang">English</a>
@else
<a href="{{ route(Route::currentRouteName(), array_replace(Route::getCurrentRoute()->parameters(), ['id' => $offer->id])) }}" class="d-xl-none lang">عربي</a>
@endif
@endsection
@section('TagCss')
<style>
.installment-payment-tamara, .installment-payment-tamara {
    display: inline-block;
}
@media screen and (max-width: 767.99px) {
    .custom-control-inline {
    display: block;
    margin: 16px;
}
}
</style>
@endsection
@section('content')
 <!-- page header -->
 <div class="page-header">
        <div class="container">
            <!-- image -->
            <div class="page-header__image">
                <picture>
                    <source srcset="{{latest(settings()->get('offer-book.imagebg.page')) }}" type="image/webp">
                    <img src="{{latest(settings()->get('offer-book.imagebg.page')) }}" draggable="false"
                        alt="page image" data-aos="zoom-out">
                </picture>
            </div>
            <!-- // image -->
            <!-- title -->
            <h1 class="h3" data-aos="fade-up" data-aos-delay="100">
            {{ $offer->name ? $offer->name : '' }}
            </h1>
            <!-- title -->
        </div>
    </div>
    <!-- // page header -->


    <!-- offers book -->
    <section class="offers-book d-pad">
        <div class="container">
            <!-- title -->
            <div class="section-title">
                <h2 class="title" data-aos="fade-up">
                {{ $offer->name ? $offer->name : '' }}
                </h2>
            </div>
            <!-- // title -->
            <div class="row">
                <!-- form -->
                <div class="col-lg-7 order-2 order-lg-1">
                    <!-- book -->
                    <div class="book__form">
                         <form class="form" method="post" action="{{ route('web.offer-booking.store', app()->getLocale() == 'en' ? ['lang' => 'en'] : '')}}">
                         @csrf
                            <!-- offer -->
                            <input type="hidden" name="source_ads" value="{{ request()->get('source') }}">
                            <input type="hidden" name="sourcelist" value="{{ request()->get('sourcelist') }}">
                            <input type="hidden" name="urlsourcelist" value="{{ request()->get('urlsourcelist') }}">
                            <div class="form-group row d-flex align-items-center" data-aos="fade-up">
                                <label for="bookOffer" class="col-lg-3 col-form-label">{{ (app()->getLocale() == 'ar') ? 'العرض' : 'Offer'}}</label>
                                <div class="col-lg-9">
                                    <select class="custom-select" id="bookOffer" name="offer_id" required>
                                       <option value="" disabled>{{ (app()->getLocale() == 'ar') ? 'العرض' : 'Offer'}}</option>
                                        @if(!empty($offer))
                                            <option value="{{ $offer->id }}" selected>{{ $offer->name }}</option>
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <!-- // offer -->
                            <!-- branch -->
                            <div class="form-group row d-flex align-items-center" data-aos="fade-up">
                                <label for="bookBranch" class="col-lg-3 col-form-label">{{ (app()->getLocale() == 'ar') ? 'الدولة' : 'Country'}}</label>
                                <div class="col-lg-9">
                                    <select class="custom-select" id="bookBranch" name="branche_id" required>
                                        <option value="" disabled>{{ (app()->getLocale() == 'ar') ? 'الدولة' : 'Country'}}</option>
                                        @if(!empty($allBranches))
                                            @foreach($allBranches as $branche)
                                            <option value="{{ $branche->id }}" {{ $offer->branche_id == $branche->id ? 'selected' : 'disabled' }}>{{ $branche->name }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <!-- // branch -->
                             <!-- branch -->
                             <div class="form-group row d-flex align-items-center" data-aos="fade-up">
                                <label for="bookBranch" class="col-lg-3 col-form-label">{{ (app()->getLocale() == 'ar') ? 'الفرع' : 'Branche'}}</label>
                                <div class="col-lg-9">
                                    <select class="custom-select" name="sub_branche_id" required>
                                        <option value="">{{ __('messages.brancherequired') }}</option>
                                        @if(count($offer->branches) > 0)
                                            @foreach($offer->branches as $branch)
                                            <option value="{{ $branch->id }}" {{ old('sub_branche_id') == $branch->id ? 'selected' : '' }}>{{ $branch->name }}</option>
                                            @endforeach
                                        @else
                                        @if(!empty($branches))
                                            @foreach($branches as $branche)
                                            <option value="{{ $branche->id }}" {{ old('sub_branche_id') == $branche->id ? 'selected' : '' }}>{{ $branche->name }}</option>
                                            @endforeach
                                        @endif
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <!-- // branch -->
                            <!-- date -->
                            <div class="form-group row d-flex align-items-center" data-aos="fade-up">
                                <label for="bookDate" class="col-lg-3 col-form-label">{{ (app()->getLocale() == 'ar') ? 'التاريخ' : 'Date'}}</label>
                                <div class="col-lg-9">
                                    <input type="date" class="form-control" id="date_picker" name="attendance_date" value="{{ old('attendance_date') }}" required>
                                </div>
                            </div>
                            <!-- // date -->
                            <!-- time -->
                            <div class="form-group row d-flex align-items-center" data-aos="fade-up">
                                <label for="bookTime" class="col-lg-3 col-form-label">{{ (app()->getLocale() == 'ar') ? 'التوقيت' : 'Time'}}</label>
                                <div class="col-lg-9">
                                    <select class="custom-select" id="bookTime" name="available_time" required>
                                        <option value="">{{ __('messages.timerequired') }}</option>
                                        <option value="{{ (app()->getLocale() == 'ar') ? 'صباحي' : 'Morning'}}">{{ (app()->getLocale() == 'ar') ? 'صباحي' : 'Morning'}}</option>
                                        <option value="{{ (app()->getLocale() == 'ar') ? 'مسائي' : 'Evening'}}">{{ (app()->getLocale() == 'ar') ? 'مسائي' : 'Evening'}}</option>
                                    </select>
                                </div>
                            </div>
                            <!-- // time -->
                            <!-- name -->
                            <div class="form-group row d-flex align-items-center" data-aos="fade-up">
                                <label for="bookName" class="col-lg-3 col-form-label">{{ __('messages.Full Name') }}</label>
                                <div class="col-lg-9">
                                    <input type="text" class="form-control" id="bookName" placeholder="{{ __('messages.namerequired') }}" name="name" value="{{ old('name') }}" required>
                                </div>
                            </div>
                            <!-- // name -->
                            <!-- phone -->
                            <div class="form-group row d-flex align-items-center" data-aos="fade-up">
                                <label for="bookPhone" class="col-lg-3 col-form-label">{{ __('messages.Phone') }}</label>
                                <div class="col-lg-9">
                                    <input type="tel" class="form-control" id="bookPhone" onchange="validateContact(this)" maxlength="10" placeholder="{{ __('messages.phonerequired') }} (05xxxxxxxx)." name="phone" value="{{ old('phone') }}" required>
                                    <div class="invalid-feedback">
                                    {{ (app()->getLocale() == 'ar') ? 'يجب أن يكون هذا الحقل جوالًا سعوديًا (05xxxxxxxx).' : 'This field must be saudi arabia mobile (05xxxxxxxx).'}}
                                    </div>
                                </div>
                            </div>
                            <!-- // phone -->
                            <!-- email -->
                            <div class="form-group row d-flex align-items-center" data-aos="fade-up">
                                <label for="bookEmail" class="col-lg-3 col-form-label">{{ __('messages.Email Address') }}</label>
                                <div class="col-lg-9">
                                    <input type="email" class="form-control" id="bookEmail" placeholder="{{ __('messages.emailrequired') }}" name="email" value="{{ old('email') }}" required>
                                </div>
                            </div>
                            <!-- // email -->
                            <!-- payment -->
                            <div class="form-group row d-flex align-items-center" data-aos="fade-up">
                                <label for="offerPayment" class="col-lg-3 col-form-label">{{ (app()->getLocale() == 'ar') ? 'الدفع' : 'Payment'}}</label>
                                <div class="col-lg-9">
                                    @if ($offer->price > 0 && $offer->status_payment == 0)
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" id="offerPayment" name="type_pay" value="Pay online" class="custom-control-input">
                                        <label class="custom-control-label" for="offerPayment"> {{ (app()->getLocale() == 'ar') ? ' أونلاين ' : ' online '}}</label>
                                    </div>
                                    @endif
                                    @if($offer->price > 0 && $offer->status_installment == 0)
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" id="Installment" name="type_pay" value="Pay with installment"  class="custom-control-input">
                                        <label class="custom-control-label" for="Installment"> {{ (app()->getLocale() == 'ar') ? ' للتقسيط ' : ' installment '}}</label>
                                    </div>
                                    @endif
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" id="cashInBranch" name="type_pay" value="Payment in branch"  class="custom-control-input" checked>
                                        <label class="custom-control-label" for="cashInBranch"> {{ (app()->getLocale() == 'ar') ? ' في الفرع ' : ' in branch '}}</label>
                                    </div>
                                </div>
                            </div>
                            <div class="installment-payment d-none">
                                <div class="form-group row d-flex align-items-center" data-aos="fade-up">
                                    <label for="PaymentInstallment" class="col-lg-3 col-form-label">{{ (app()->getLocale() == 'ar') ? ' التقسيط ' : ' Installment '}}</label>
                                    <div class="col-lg-9">
                                        @if($offer->price >= '99')
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input type="radio" id="TamaraInstallment" name="installment_pay" value="Tamara" class="custom-control-input">
                                            <label class="custom-control-label" for="TamaraInstallment"> {{ (app()->getLocale() == 'ar') ? ' تمارا ' : ' Tamara '}}</label>
                                        </div>
                                        @endif
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input type="radio" id="TabbyInstallment" name="installment_pay" value="Tabby"  class="custom-control-input">
                                            <label class="custom-control-label" for="TabbyInstallment"> {{ (app()->getLocale() == 'ar') ? ' تابي ' : ' Tabby'}}</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- // payment -->
                            <!-- online payment -->
                            <div class="installment-payment-tamara d-none">
                               <div class="card">
                                    <div class="book-offer__info mb-3">
                                        <div class="tamara-product-widget" data-lang="{{ app()->getLocale() }}" data-price="{{ $offer->price ? $offer->price : '0' }}" data-currency="SAR" data-country-code="SA" data-color-type="default" data-show-border="false" data-payment-type="installment" data-disable-installment="false" data-disable-paylater="true" >

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="installment-payment-tabby d-none">
                               <div class="card">
                                    <div class="book-offer__info mb-3">
                                       <div id="tabbyCard">

                                       </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row d-flex align-items-center" data-aos="fade-up">
                                <label for="checkterms" class="col-lg-3 col-form-label"></label>
                                <div class="col-lg-9">
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="checkbox" id="checkterms" name="check_terms" value="check terms" class="custom-control-input" required>
                                        <label class="custom-control-label" for="checkterms"> <a href="{{ route('web.offers.terms', app()->getLocale() == 'en' ? ['lang' => 'en'] : '') }}" target="_blank" @if(app()->getLocale() == 'ar') style="color: black;padding: 0px; margin-left: 226px;" @else style="color: black;padding: 0px; margin-right: 135px;" @endif> {{ (app()->getLocale() == 'ar') ? ' أوافق على الشروط واﻷحكام ' : ' I agree to the terms and conditions '}}  </a></label>
                                    </div>
                                </div>
                            </div>
                            <!-- // online payment -->
                            <!-- btn -->
                            <div class="row d-flex align-items-center">
                                <div class="col-lg-3"></div>
                                <div class="col-lg-9">
                                    <button type="submit" class="btn btn-brand-primary btn-form Booking_offer_ads" data-aos="fade-up">
                                        {{ (app()->getLocale() == 'ar') ? 'إحجز العرض الآن' : 'Book the offer now'}}
                                        <svg class="btn-icon">
                                            <use href="{{latest('/web/assets/images/icons/icons.svg#book')}}"></use>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                            <!-- // btn -->
                        </form>
                    </div>
                    <!-- // book -->
                </div>
                <!-- // form -->
                <!-- offer info -->
                <div class="col-lg-5 order-1 order-lg-2">
                    <div class="book-offer__info">
                        <div class="book-offer__image">
                            <picture>
                                <source srcset="{{ $offer->image ? $offer->image : '' }}" type="image/webp"><img src="{{ $offer->image ? $offer->image : '' }}"
                                    draggable="false" loading="lazy" data-aos="zoom-out" alt="offer">
                            </picture>
                        </div>
                        <div class="offer-list__info text-center">
                            <div class="offer-list__title">
                                <h3 class="h6">
                                {{ $offer->name ? $offer->name : '' }}
                                </h3>
                                <div id="discountGroup" class="discountGroup d-none">
                                @if ($offer->price > 0)
                                   @if($offer->price_after_discount > 0)
                                    <span class="h5 color">
                                    <del style="font-size: medium;color: red;">{{ $offer->price ? $offer->price : '0' }}</del> <small>{{ $offer->branche->currency ? $offer->branche->currency : '' }}</small>
                                    </span>
                                    <br>
                                    <span class="h5 colorv2">
                                    <strong style="color: #8cc63f;font-size: xx-large;">{{ $offer->price_after_discount ? $offer->price_after_discount : '0' }}</strong> <small>{{ $offer->branche->currency ? $offer->branche->currency : '' }}</small>
                                    </span>
                                    @else
                                    <span class="h5 color">
                                    {{ $offer->price ? $offer->price : '0' }} <small>{{ $offer->branche->currency ? $offer->branche->currency : '' }}</small>
                                    </span>
                                    @endif
                                @endif
                                </div>
                                <div id="NotdiscountGroup" class="NotdiscountGroup">
                                @if ($offer->price > 0)
                                    <span class="h5 color">
                                    {{ $offer->price ? $offer->price : '0' }} <small>{{ $offer->branche->currency ? $offer->branche->currency : '' }}</small>
                                    </span>
                                @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- // offer info -->
            </div>
        </div>
    </section>
    <!-- // offers book -->
@endsection
@section('submit.scripts')
<script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.9/jquery.validate.js"></script>

<script language="javascript">
    $(document).ready(function(){
        var today = new Date();
        var dd = String(today.getDate()).padStart(2, '0');
        var mm = String(today.getMonth() + 1).padStart(2, '0');
        var yyyy = today.getFullYear();

        today = yyyy + '-' + mm + '-' + dd;

        $('#date_picker').attr('min',today).attr('value',today);
   });
</script>

<script>
        $(document).ready(function(){
            $("input[type='radio']").click(function(){
                var radioValue = $("input[name='type_pay']:checked").val();
                if(radioValue == "Payment in branch"){
                    $(".NotdiscountGroup").removeClass("d-none");
                    $(".discountGroup").addClass("d-none");
                } else if (radioValue == "Pay with installment") {
                    $(".NotdiscountGroup").removeClass("d-none");
                    $(".discountGroup").addClass("d-none");
                } else {
                    $(".discountGroup").removeClass("d-none");
                    $(".NotdiscountGroup").addClass("d-none");
                }
            });
        });
        $("#Installment").click(function () {
            $(".installment-payment").removeClass("d-none");
            $(".NotdiscountGroup").removeClass("d-none");
            $(".discountGroup").addClass("d-none");
        });
        $("#cashInBranch").click(function () {
            $(".installment-payment").addClass("d-none");
            $(".installment-payment-tamara").addClass("d-none");
            $(".installment-payment-tabby").addClass("d-none").css("display", "inline-block");
            $(".NotdiscountGroup").removeClass("d-none");
            $(".discountGroup").addClass("d-none");
            $("#TamaraInstallment").prop('checked', false);
            $("#TabbyInstallment").prop('checked', false);
        });
        $("#offerPayment").click(function () {
            $(".installment-payment").addClass("d-none");
            $(".installment-payment-tamara").addClass("d-none");
            $(".installment-payment-tabby").addClass("d-none").css("display", "inline-block");
            $(".discountGroup").removeClass("d-none");
            $(".NotdiscountGroup").addClass("d-none");
            $("#TamaraInstallment").prop('checked', false);
            $("#TabbyInstallment").prop('checked', false);
        });

        $("#TamaraInstallment").click(function () {
            $(".installment-payment-tamara").removeClass("d-none");
            $(".installment-payment-tabby").addClass("d-none").css("display", "inline-block");
        });
        $("#TabbyInstallment").click(function () {
            $(".installment-payment-tamara").addClass("d-none");
            $(".installment-payment-tabby").removeClass("d-none").css("display", "inline-block");
        });

        function validateContact(tel) {

        var xyz=document.getElementById('bookPhone').value.trim();

        var  phoneno = /^\d{10}$/;
        if((tel.value.match(phoneno)) && tel.value.length == 10 && xyz.substr(0,2)==='05' && $.isNumeric(xyz))
            {
                $(tel).removeClass('is-invalid');
                $(tel).addClass('is-valid');

            }
        else
            {
                $("#bookPhone").val('');
                $(tel).removeClass('is-valid');
                $(tel).addClass('is-invalid');

            }
        }

</script>

<script src="https://cdn.tamara.co/widget/product-widget.min.js"></script>

<script>
    setTimeout(() => {
    if (window.TamaraProductWidget) {
        window.TamaraProductWidget.init({ lang: 'en' })
        window.TamaraProductWidget.render()
    }
    }, 2000) // Waiting for 2s - Make sure Tamara's widget is installed
</script>

<script src="https://checkout.tabby.ai/tabby-promo.js"></script>
<script>
    new TabbyPromo({
    selector: '#tabbyCard', // required, content of tabby Promo Snippet will be placed in element with that selector
    currency: 'SAR', // required, currency of your product
    price: '{{ $offer->price ? $offer->price : '0' }}', // required, price or your product
    installmentsCount: 4, // Optional - custom installments number for tabby promo snippet (if not downpayment + 3 installments)
    lang: '{{ app()->getLocale() }}', // optional, language of snippet and popups, if the property is not set, then it is based on the attribute 'lang' of your html tag
    source: 'product', // optional, snippet placement; `product` for product page and `cart` for cart page
    api_key: '{{ $ApiKey }}' // optional, public key which identifies your account when communicating with tabby
    });
</script>
@endsection
