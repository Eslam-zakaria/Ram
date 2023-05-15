@extends('Page.Resources.views.bh.base')
@section('scripts')
    {!!  settings()->get('thanks.bh.scripts') !!}
@endsection
@section('content')

    <div class="thanks-wrapper">

        <!-- navbar -->

        <!-- // navbar -->


        <!-- thanks -->
        <div class="thanks text-center">
            <div class="container">
                <div class="thanks__msg">
                    <div class="thanks__msg-icon" data-aos="zoom-in-up" data-aos-delay="200">
                        <img src="{{latest('assets/images/thanks.svg')}}" alt="Thank you" draggable="false">
                    </div>
                    <div class="thanks__msg-text">
                            <h2 class="color">
                                شكراً لك . لقد تم استلام طلبك
                            </h2>

                            <h6>
                                تابعنا على وسائل التواصل الإجتماعي
                            </h6>

                        <p>
                            سيتم التواصل معكم من قبل قسم خدمة العملاء خلال ٢٤ ساعة للتأكيد أو إعادة جدولة الموعد حسب
                            المواعيد المتاحة
                        </p>
                        <a href="{{ url()->previous() }}" class="btn btn-green">عودة</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- // thanks -->

        <footer class="footer text-center">
            <div class="container">
                <div class="small">
                    جميع الحقوق محفوظة &copy; عيادات رام - فرع البحرين
                </div>
            </div>
        </footer>
        <!-- // foooter -->

    </div>

@endsection
@section('submit.scripts')
    {!! settings()->get('thanks.bh.body.scripts') !!}
@endsection
