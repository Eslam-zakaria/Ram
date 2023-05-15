<?php

use App\Constants\Templates;
use Modules\Setting\Models\Setting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Setting::create([
            'ar' => [
                'name' => 'رقم التليفون',
                'value' => '201018055565'
            ],
            'en' => [
                'name' => 'Phone Number',
                'value' => '201018055565'
            ],
            'key' => 'common.phone',
        ]);

        Setting::create([
            'ar' => [
                'name' => 'رقم التليفون',
                'value' => '0133334050'
            ],
            'en' => [
                'name' => 'Phone Number',
                'value' => '0133334050'
            ],
            'key' => 'common.phone.1',
        ]);

        Setting::create([
            'en' => [
                'name' => 'WhatsApp Number',
                'value' => 'https://wa.me/+201018055565'
            ],
            'ar' => [
                'name' => 'رقم الواتس اب',
                'value' => 'https://wa.me/+201018055565'
            ],
            'key' => 'common.whatsapp',
        ]);

        Setting::create([
            'en' => [
                'name' => 'App Store Link',
                'value' => 'https://alkahhal.com.sa/'
            ],
            'ar' => [
                'name' => 'لينك اب ستور',
                'value' => 'https://alkahhal.com.sa/'
            ],
            'key' => 'socials.appstore',
        ]);

        Setting::create([
            'en' => [
                'name' => 'Google Play Link',
                'value' => 'https://alkahhal.com.sa/'
            ],
            'ar' => [
                'name' => 'لينك جوجل ',
                'value' => 'https://alkahhal.com.sa/'
            ],

            'key' => 'socials.googleplay',
        ]);

        Setting::create([
            'ar' => [
                'name' => 'Youtube Link',
                'value' => 'https://alkahhal.com.sa/'
            ],
            'en' => [
                'name' => 'Youtube Link',
                'value' => 'https://alkahhal.com.sa/'
            ],
            'key' => 'socials.youtube',
        ]);


        Setting::create([
            'ar' => [
                'name' => 'Twitter Link',
                'value' => 'https://alkahhal.com.sa/'
            ],
            'en' => [
                'name' => 'Twitter Link',
                'value' => 'https://alkahhal.com.sa/'
            ],
            'key' => 'socials.twitter',
        ]);


        Setting::create([
            'ar' => [
                'name' => 'Linkedin Link',
                'value' => 'https://alkahhal.com.sa/'
            ],
            'en' => [
                'name' => 'Linkedin Link',
                'value' => 'https://alkahhal.com.sa/'
            ],
            'key' => 'socials.linkedin',
        ]);

        Setting::create([
            'ar' => [
                'name' => 'Instagram Link',
                'value' => 'https://alkahhal.com.sa/'
            ],
            'en' => [
                'name' => 'Instagram Link',
                'value' => 'https://alkahhal.com.sa/'
            ],
            'key' => 'socials.insta',
        ]);

        Setting::create([
            'ar' => [
                'name' => 'Facebook Link',
                'value' => 'https://alkahhal.com.sa/'
            ],
            'en' => [
                'name' => 'Facebook Link',
                'value' => 'https://alkahhal.com.sa/'
            ],
            'key' => 'socials.fb',
        ]);

        Setting::create([
            'ar' => [
                'name' => 'Dammam Landline',
                'value' => '2274209544'
            ],
            'en' => [
                'name' => 'Dammam Landline',
                'value' => '2274209544'
            ],
            'name' => 'Dammam Landline',
            'key' => 'dammam.landline',
        ]);

        Setting::create([
            'ar' => [
                'name' => 'Dammam Mobile',
                'value' => '201018055565'
            ],
            'en' => [
                'name' => 'Dammam Mobile',
                'value' => '201018055565'
            ],
            'key' => 'dammam.mobile',
        ]);

        Setting::create([
            'ar' => [
                'name' => 'Dammam Fax',
                'value' => '2274209544'
            ],
            'en' => [
                'name' => 'Dammam Fax',
                'value' => '2274209544'
            ],
            'key' => 'dammam.fax',
        ]);

        Setting::create([
            'ar' => [
                'name' => 'Dammam Location (Embed)',
                'value' => "https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d7142.882915097735!2d50.09023763330789!3d26.473727383318607!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3e49fea90b63e9b5%3A0xa6d890753e9d119!2sKahhal%20Medical%20Complex!5e0!3m2!1sen!2seg!4v1620483821212!5m2!1sen!2seg"
            ],
            'en' => [
                'name' => 'Dammam Location (Embed)',
                'value' => "https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d7142.882915097735!2d50.09023763330789!3d26.473727383318607!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3e49fea90b63e9b5%3A0xa6d890753e9d119!2sKahhal%20Medical%20Complex!5e0!3m2!1sen!2seg!4v1620483821212!5m2!1sen!2seg"
            ],
            'key' => 'dammam.location',
        ]);

        Setting::create([
            'ar' => [
                'name' => 'Ahsaa Location (Embed)',
                'value' => "https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d7142.882915097735!2d50.09023763330789!3d26.473727383318607!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3e49fea90b63e9b5%3A0xa6d890753e9d119!2sKahhal%20Medical%20Complex!5e0!3m2!1sen!2seg!4v1620483821212!5m2!1sen!2seg"
            ],
            'en' => [
                'name' => 'Ahsaa Location (Embed)',
                'value' => "https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d7142.882915097735!2d50.09023763330789!3d26.473727383318607!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3e49fea90b63e9b5%3A0xa6d890753e9d119!2sKahhal%20Medical%20Complex!5e0!3m2!1sen!2seg!4v1620483821212!5m2!1sen!2seg"
            ],
            'key' => 'ahsaa.location',
        ]);

        Setting::create([
            'ar' => [
                'name' => 'Dammam Link Location',
                'value' => 'https://www.google.com/maps/place/Kahhal+Medical+Complex/@26.4737274,50.0924263,15z/data=!3m1!4b1!4m5!3m4!1s0x3e49fea90b63e9b5:0xa6d890753e9d119!8m2!3d26.4737274!4d50.094615'
            ],
            'en' => [
                'name' => 'Dammam Location',
                'value' => 'https://www.google.com/maps/place/Kahhal+Medical+Complex/@26.4737274,50.0924263,15z/data=!3m1!4b1!4m5!3m4!1s0x3e49fea90b63e9b5:0xa6d890753e9d119!8m2!3d26.4737274!4d50.094615'
            ],
            'key' => 'dammam.location.link',
        ]);

        Setting::create([
            'ar' => [
                'name' => 'Ahsaa Location',
                'value' => 'https://www.google.com/maps/place/Kahhal+Medical+Complex/@26.4737274,50.0924263,15z/data=!3m1!4b1!4m5!3m4!1s0x3e49fea90b63e9b5:0xa6d890753e9d119!8m2!3d26.4737274!4d50.094615'
            ],
            'en' => [
                'name' => 'Ahsaa Location',
                'value' => 'https://www.google.com/maps/place/Kahhal+Medical+Complex/@26.4737274,50.0924263,15z/data=!3m1!4b1!4m5!3m4!1s0x3e49fea90b63e9b5:0xa6d890753e9d119!8m2!3d26.4737274!4d50.094615'
            ],
            'key' => 'ahsaa.location.link',
        ]);


        Setting::create([
            'ar' => [
                'name' => 'Ahsaa Landline',
                'value' => '2274209544'
            ],
            'en' => [
                'name' => 'Ahsaa Landline',
                'value' => '2274209544'
            ],
            'key' => 'ahsaa.landline',
        ]);

        Setting::create([
            'ar' => [
                'name' => 'Ahsaa Mobile',
                'value' => '201018055565'
            ],
            'en' => [
                'name' => 'Ahsaa Mobile',
                'value' => '201018055565'
            ],
            'key' => 'ahsaa.mobile',
        ]);

        Setting::create([
            'ar' => [
                'name' => 'Ahsaa Fax',
                'value' => '2274209544'
            ],
            'en' => [
                'name' => 'Ahsaa Fax',
                'value' => '2274209544'
            ],
            'key' => 'ahsaa.fax',
        ]);

        Setting::create([
            'ar' => [
                'name' => 'نص تواصل معنا',
                'value' => 'تفضل بزيارة مركز المساعدة الخاص بنا على مدار الساعة طوال أيام الأسبوع أو راسلنا عبر البريد الإلكتروني - مهما كان الأمر ، فنحن مستعدون لتقديم المزيد من المساعدة لك.'
            ],
            'en' => [
                'name' => 'Contact Us Text',
                'value' => 'Please visit our 24/7 Help Center or email us - whatever it is, we stand ready to provide you further assistance.'
            ],
            'key' => 'contact.text',
        ]);

        Setting::create([
            'ar' => [
                'name' => 'عن الأطباء',
                'value' => '<h2 class="title" data-aos="fade-up">
                فريقنا <span class="color">الرائع</span>
            </h2>
            <p data-aos="fade-up" data-aos-delay="100">
                تم إنشاء أداتنا الأبجدية لخدمة مصممي المواقع، ومدراء المواقع ومسوقين المحتوى. إذا كنت تحتاج إلى نص ينوب عن محتوى لم يتم إنشائه بعد
            </p>'
            ],
            'en' => [
                'name' => 'Doctors About Page',
                'value' => '<h2 class="title" data-aos="fade-up">
                Our Great <span class="color">Doctors</span>
            </h2>
            <p data-aos="fade-up" data-aos-delay="100">
                You will live a unique experience during your treatment because we are pioneers in healthcare with a comfortable environment and
                integrated care that we provide to you.
            </p>'
            ],
            'key' => 'docrots.about.page',
        ]);

        Setting::create([
            'ar' => [
                'name' => 'الفروع',
                'value' => '<h2 class="title" data-aos="fade-up">
                فروع رام <br>
                حولك <span class="color">أينما كنت</span>
            </h2>
            <p data-aos="fade-up" data-aos-delay="100">
                هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي القارئ عن التركيز على الشكل الخارجي للنص.
            </p>'
            ],
            'en' => [
                'name' => 'Branches About Page',
                'value' => '<h2 class="title" data-aos="fade-up">
                Our Branches <br>
                around you <span class="color">wherever you are</span>
            </h2>
            <p data-aos="fade-up" data-aos-delay="100">
                You will live a unique experience during your treatment because we are pioneers in healthcare with a comfortable environment and
                integrated care that we provide to you.
            </p>'
            ],
            'key' => 'branches.about.page',
        ]);

        Setting::create([
            'ar' => [
                'name' => 'الخدمات',
                'value' => '<h2 class="title" data-aos="fade-up">
                            <span class="color">خدمات </span> عيادات رام
                        </h2>
                        <p data-aos="fade-up" data-aos-delay="100">
                            تم إنشاء أداتنا الأبجدية لخدمة مصممي المواقع، ومدراء المواقع ومسوقين المحتوى. إذا كنت تحتاج إلى نص ينوب عن محتوى لم يتم إنشائه بعد
                        </p>'
            ],
            'en' => [
                'name' => 'Services About Page',
                'value' => '<h2 class="title" data-aos="fade-up">
                            <span class="color">Ram Clinics</span> Services
                        </h2>
                        <p data-aos="fade-up" data-aos-delay="100">
                            You will live a unique experience during your treatment because we are pioneers in healthcare with a comfortable environment and
                            integrated care that we provide to you.
                        </p>'
            ],
            'key' => 'services.about.page',
        ]);

        Setting::create([
            'ar' => [
                'name' => 'الحجز',
                'value' => '<h2 class="title" data-aos="fade-up">
                            إحجز موعدك <span class="color">الآن</span>
                        </h2>
                        <p data-aos="fade-up" data-aos-delay="100">
                            لحجز موعد مسبق في عيادات رام أدخل البيانات المطلوبة وسيتم التواصل معك من فريق خدمة العملاء لتأكيد الحجز.
                        </p>'
            ],
            'en' => [
                'name' => 'Book Title Page',
                'value' => '<h2 class="title" data-aos="fade-up">
                            Book Your Appointment <span class="color">Now</span>
                        </h2>
                        <p data-aos="fade-up" data-aos-delay="100">
                            You will live a unique experience during your treatment because we are pioneers in healthcare with a comfortable environment and
                            integrated care that we provide to you.
                        </p>'
            ],
            'key' => 'book.title.page',
        ]);

        Setting::create([
            'ar' => [
                'name' => 'صوره صفحه الحجز',
                'value' => '/web/assets/images/book.jpg'
            ],
            'en' => [
                'name' => 'Book Image Page',
                'value' => '/web/assets/images/book.jpg'
            ],
            'key' => 'book.image.page',
        ]);

        Setting::create([
            'ar' => [
                'name' => 'Thank You Page',
                'value' => '<h2 class="title" data-aos="fade-up">
                                شكراً لك،، <br>
                                <span class="color">لقد تلقينا رسالتك</span>
                            </h2>
                            <p class="lead" data-aos="fade-up" data-aos-delay="100">
                                إذا كنت تحتاج إلى نص ينوب عن محتوى لم يتم إنشائه بعد، يمكنك استخدام هذه الأداة. بهذه الطريقة، يصبح بإمكان مصممي
                                الرسومات ومطوري المواقع، الخ التركيز على العناصر الرئيسية الأخرى
                            </p>'
            ],
            'en' => [
                'name' => 'Thank You Page',
                'value' => '<h2 class="title" data-aos="fade-up">
                                Thank you, <br>
                                <span class="color">We have received your Message</span>
                            </h2>
                            <p class="lead" data-aos="fade-up" data-aos-delay="100">
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Esse quos saepe obcaecati inventore ut quidem voluptatibus est. Ad fugit
                                laborum eaque delectus qui! Tempore ullam iusto, recusandae id voluptatum ipsam.
                            </p>'
            ],
            'key' => 'thanks.title.page',
        ]);

        Setting::create([
            'ar' => [
                'name' => 'قسط خدماتك الآن',
                'value' => '<h2 class="title" data-aos="fade-up">
                                إبتسم الآن، <span class="color">وإدفع لاحقاً</span>
                            </h2>
                            <p data-aos="fade-up" data-aos-delay="100">
                                في عيادات رام ستعيش تجربة فريدة من نوعها أثناء فترة علاجك لأننا رائدون في الرعاية الطبية بوجود بيئة مريحة ورعاية متكاملة نوفرها
                                لك، كما إننا نهدف الى بناء جسور الثقة مع جميع عملاؤنا عن طريق التعليم.
                            </p>'
            ],
            'en' => [
                'name' => 'Installment Title Page',
                'value' => '<h2 class="title" data-aos="fade-up">
                                Smile now, <span class="color">Pay Later</span>
                            </h2>
                            <p data-aos="fade-up" data-aos-delay="100">
                                You will live a unique experience during your treatment because we are pioneers in healthcare with a comfortable environment and
                                integrated care that we provide to you.
                            </p>'
            ],
            'key' => 'installment.title.page',
        ]);

        Setting::create([
            'ar' => [
                'name' => 'صوره صفحه قسط خدماتك',
                'value' => '/web/assets/images/installment.png'
            ],
            'en' => [
                'name' => 'Installment Image Page',
                'value' => '/web/assets/images/installment.png'
            ],
            'key' => 'installment.image.page',
        ]);

        Setting::create([
            'ar' => [
                'name' => 'مواعيد العمل فى الصفحة الرئيسية',
                'value' => '<div class="overlay-bg__block">
                                <h2 class="h6 color">السبت إلى الخميس:</h2>
                                <p>08:00 صباحاً إلى 12:00 صباحاً</p>
                            </div>
                            <div class="overlay-bg__block">
                                <h2 class="h6 color">الجمعة:</h2>
                                <p>4:00 مساءً إلى 10:00مساءً</p>
                            </div>'
            ],
            'en' => [
                'name' => 'Times of work home page',
                'value' => '<div class="overlay-bg__block">
                                <h2 class="h6 color">Saturday to Thursday:</h2>
                                <p>8:00AM to 12:00AM</p>
                            </div>
                            <div class="overlay-bg__block">
                                <h2 class="h6 color">Friday:</h2>
                                <p>4:00PM to 10:00PM</p>
                            </div>'
            ],
            'key' => 'timework.home.page',
        ]);

        Setting::create([
            'ar' => [
                'name' => 'فروعنا حولك أينما كنت',
                'value' => '<div class="overlay-bg__block">
                            <h2 class="h6 color">فروعنا حولك أينما كنت</h2>
                            <p>إضغط هنا لمعرفة الفرع الأقرب إليك</p>
                        </div>'
            ],
            'en' => [
                'name' => 'Our branches are around you',
                'value' => '<div class="overlay-bg__block">
                            <h2 class="h6 color">Our branches are around you</h2>
                            <p>Click to know your nearest branch</p>
                        </div>'
            ],
            'key' => 'briefbranches.home.page',
        ]);

        Setting::create([
            'ar' => [
                'name' => 'titles header offer page',
                'value' => 'عروض الجمعة البيضاء'
            ],
            'en' => [
                'name' => 'titles header offer page',
                'value' => 'White Friday Offers'
            ],
            'key' => 'titlesheader.offer.page',
        ]);

        Setting::create([
            'ar' => [
                'name' => 'الصوره الخلفية صفحه العروض',
                'value' => '/web/assets/images/offers-bg.jpg'
            ],
            'en' => [
                'name' => 'Offer Image-bg Page',
                'value' => '/web/assets/images/offers-bg.jpg'
            ],
            'key' => 'offer.imagebg.page',
        ]);

        Setting::create([
            'ar' => [
                'name' => 'titles section offer page',
                'value' => '<h2 class="title" data-aos="fade-up">
                                <span class="color">عروض</span> الجمعة البيضاء
                            </h2>
                            <p data-aos="fade-up" data-aos-delay="100">
                                ستعيش تجربة فريدة أثناء علاجك لأننا رواد في الرعاية الصحية مع بيئة مريحة و الرعاية المتكاملة التي نقدمها لك.
                            </p>'
            ],
            'en' => [
                'name' => 'titles section offer page',
                'value' => '<div class="section-title">
                            <h2 class="title" data-aos="fade-up">
                                <span class="color">White Friday</span> Offers
                            </h2>
                            <p data-aos="fade-up" data-aos-delay="100">
                                You will live a unique experience during your treatment because we are pioneers in healthcare with a comfortable environment and
                                integrated care that we provide to you.
                            </p>
                            </div>'
            ],
            'key' => 'titlessection.offer.page',
        ]);

        Setting::create([
            'ar' => [
                'name' => 'titles header offer-list page',
                'value' => 'عروض الجمعة البيضاء فرع'
            ],
            'en' => [
                'name' => 'titles header offer-list page',
                'value' => 'White Friday Offers Branche'
            ],
            'key' => 'titlesheader.offer-list.page',
        ]);

        Setting::create([
            'ar' => [
                'name' => 'الصوره الخلفية صفحه Offer-list',
                'value' => '/web/assets/images/offers-bg.jpg'
            ],
            'en' => [
                'name' => 'Offer-list Image-bg Page',
                'value' => '/web/assets/images/offers-bg.jpg'
            ],
            'key' => 'offer-list.imagebg.page',
        ]);

        Setting::create([
            'ar' => [
                'name' => 'statistic country home',
                'value' => '<span class="small">أكثر من</span>
                            <h2 class="h3">20</h2>
                            <span class="lead">دولة</span>'
            ],
            'en' => [
                'name' => 'statistic country home',
                'value' => '<span class="small">More than</span>
                            <h2 class="h3">20</h2>
                            <span class="lead">Country</span>'
            ],
            'key' => 'statistic.country.home.page',
        ]);

        Setting::create([
            'ar' => [
                'name' => 'statistic branch home',
                'value' => '<span class="small">أكثر من</span>
                            <h2 class="h3">50</h2>
                            <span class="lead">فرع</span>'
            ],
            'en' => [
                'name' => 'statistic branch home',
                'value' => '<span class="small">More than</span>
                            <h2 class="h3">50</h2>
                            <span class="lead">Branch</span>'
            ],
            'key' => 'statistic.branch.home.page',
        ]);

        Setting::create([
            'ar' => [
                'name' => 'statistic doctor home',
                'value' => '<span class="small">أكثر من</span>
                            <h2 class="h3">400</h2>
                            <span class="lead">طبيب</span>'
            ],
            'en' => [
                'name' => 'statistic doctor home',
                'value' => '<span class="small">More than</span>
                            <h2 class="h3">400</h2>
                            <span class="lead">Doctor</span>'
            ],
            'key' => 'statistic.doctor.home.page',
        ]);

        Setting::create([
            'ar' => [
                'name' => 'statistic client home',
                'value' => '<span class="small">أكثر من</span>
                            <h2 class="h3">1000000</h2>
                            <span class="lead">عميل</span>'
            ],
            'en' => [
                'name' => 'statistic client home',
                'value' => '<span class="small">More than</span>
                            <h2 class="h3">1000000</h2>
                            <span class="lead">Client</span>'
            ],
            'key' => 'statistic.client.home.page',
        ]);

        Setting::create([
            'ar' => [
                'name' => 'statistic client home',
                'value' => '<h2 class="title" data-aos="fade-up">
                                نخبة من الإستشاريين والإخصائيين
                                <span class="color">
                                    في كافة التخصصات
                                </span>
                            </h2>
                            <p class="lead" data-aos="fade-up" data-aos-delay="200">
                                ستعيش تجربة فريدة من نوعها خلال فترة علاجك.
                            </p>
                            <p data-aos="fade-up" data-aos-delay="300">
                                لأننا رواد في الرعاية الطبية ببيئة مريحة ورعاية متكاملة نقدمها لكم. نحن أيضا
                                نهدف إلى بناء جسور الثقة مع جميع عملائنا من خلال التعليم والتثقيف الصحي بالإضافة إلى المصداقية.
                            </p>'
            ],
            'en' => [
                'name' => 'statistic client home',
                'value' => '<h2 class="title" data-aos="fade-up">
                            A selection of Consultants and Specialists
                            <span class="color">
                                in all Fields.
                            </span>
                        </h2>
                        <p class="lead" data-aos="fade-up" data-aos-delay="200">
                            You will live a unique experience during your treatment.
                        </p>
                        <p data-aos="fade-up" data-aos-delay="300">
                            Because we are pioneers in medical care with a comfortable environment and integrated care that we provide to you. We also
                            aim to build bridges of trust with all our clients through education and health education in addition to credibility.
                        </p>'
            ],
            'key' => 'about.home.page',
        ]);

        Setting::create([
            'ar' => [
                'name' => 'free-services section home',
                'value' => '<span class="overline" data-aos="fade-up">
                                إشترك الآن وإربح
                            </span>
                            <h2 class="h4" data-aos="fade-up" data-aos-delay="100">
                                برنامج سحب شهري على <span class="color">خدمات مجانية!</span>
                            </h2>
                            <p data-aos="fade-up" data-aos-delay="200">
                                سيتم إعلان الفائزين مع بداية كل شهر
                            </p>'
            ],
            'en' => [
                'name' => 'free-services section home',
                'value' => '<span class="overline" data-aos="fade-up">
                                Join Now
                            </span>
                            <h2 class="h4" data-aos="fade-up" data-aos-delay="100">
                                Monthly withdrawal program on <span class="color">Free Services!</span>
                            </h2>
                            <p data-aos="fade-up" data-aos-delay="200">
                                Winners will be announced at the beginning of each month.
                            </p>'
            ],
            'key' => 'free-services.section.home',
        ]);

        Setting::create([
            'ar' => [
                'name' => 'rate section home',
                'value' => '<span class="overline" data-aos="fade-up">
                                يسعدنا تقييم زيارتك للفروع
                            </span>
                            <h2 class="h4" data-aos="fade-up" data-aos-delay="100">
                                هل قمت بزيارة عيادات رام مؤخراً؟ <span class="color">قيم زيارتك الآن!</span>
                            </h2>
                            <p data-aos="fade-up" data-aos-delay="200">
                                قيم مستوى الخدمة التي قدمت إليك.
                            </p>'
            ],
            'en' => [
                'name' => 'rate section home',
                'value' => '<span class="overline" data-aos="fade-up">
                                Rate your Visit
                            </span>
                            <h2 class="h4" data-aos="fade-up" data-aos-delay="100">
                                Have you been to Ram Clinics recently? <span class="color">Rate your visit now!</span>
                            </h2>
                            <p data-aos="fade-up" data-aos-delay="200">
                                Evaluate the level of service provided to you.
                            </p>'
            ],
            'key' => 'rate.section.home',
        ]);

        Setting::create([
            'ar' => [
                'name' => 'services about section home',
                'value' => '<h2 class="title" data-aos="fade-up">
                                <span class="color">خدمات </span> عيادات رام
                            </h2>
                            <p data-aos="fade-up" data-aos-delay="100">
                                ستعيش تجربة فريدة أثناء علاجك لأننا رواد في الرعاية الصحية مع بيئة مريحة و
                                الرعاية المتكاملة التي نقدمها لك.
                            </p>'
            ],
            'en' => [
                'name' => 'services about section home',
                'value' => '<h2 class="title" data-aos="fade-up">
                                <span class="color">Ram Clinics</span> Services
                            </h2>
                            <p data-aos="fade-up" data-aos-delay="100">
                                You will live a unique experience during your treatment because we are pioneers in healthcare with a comfortable environment and
                                integrated care that we provide to you.
                            </p>'
            ],
            'key' => 'services.section.home',
        ]);

        Setting::create([
            'ar' => [
                'name' => 'installments about section home',
                'value' => 'إبتسم الآن، <span class="color">إدفع لاحقاً!</span> <br>
                            قسط خدماتك <span class="color">بسعر الكاش.</span>'
            ],
            'en' => [
                'name' => 'installments about section home',
                'value' => 'Smile now, <span class="color">pay later</span> <br>
                           Install all your services at a <span class="color">cash price.</span>'
            ],
            'key' => 'installments.section.home',
        ]);

        Setting::create([
            'ar' => [
                'name' => 'video section home page',
                'value' => '/web/assets/videos/reviews.mp4'
            ],
            'en' => [
                'name' => 'video section home page',
                'value' => '/web/assets/videos/reviews.mp4'
            ],
            'key' => 'video.home.page',
        ]);

        Setting::create([
            'ar' => [
                'name' => 'الصوره الخلفية صفحه Offer-book',
                'value' => '/web/assets/images/offers-bg.jpg'
            ],
            'en' => [
                'name' => 'Offer-book Image-bg Page',
                'value' => '/web/assets/images/offers-bg.jpg'
            ],
            'key' => 'offer-book.imagebg.page',
        ]);

        Setting::create([
            'ar' => [
                'name' => 'Thank You Offer Book Page',
                'value' => '<h2 class="title" data-aos="fade-up">
                                شكراً لك،، <br>
                                <span class="color">لقد تلقينا رسالتك</span>
                            </h2>
                            <p class="lead" data-aos="fade-up" data-aos-delay="100">
                                إذا كنت تحتاج إلى نص ينوب عن محتوى لم يتم إنشائه بعد، يمكنك استخدام هذه الأداة. بهذه الطريقة، يصبح بإمكان مصممي
                                الرسومات ومطوري المواقع، الخ التركيز على العناصر الرئيسية الأخرى
                            </p>'
            ],
            'en' => [
                'name' => 'Thank You Offer Book Page',
                'value' => '<h2 class="title" data-aos="fade-up">
                                Thank you, <br>
                                <span class="color">We have received your Message</span>
                            </h2>
                            <p class="lead" data-aos="fade-up" data-aos-delay="100">
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Esse quos saepe obcaecati inventore ut quidem voluptatibus est. Ad fugit
                                laborum eaque delectus qui! Tempore ullam iusto, recusandae id voluptatum ipsam.
                            </p>'
            ],
            'key' => 'thanks.title.offerbook.page',
        ]);

        Setting::create([
            'ar' => [
                'name' => 'السحب الشهري لخدمات رام المجانية',
                'value' => '<h2 class="title" data-aos="fade-up">
                                السحب الشهري <span class="color">لشهر أكتوبر 2021</span>
                                لخدمات رام المجانية
                            </h2>
                            <p data-aos="fade-up" data-aos-delay="100">
                                إشترك الآن في برنامج السحب الشهري للفرصة بالفوز بالخدمه التي تريدها مجاناً.
                            </p>'
            ],
            'en' => [
                'name' => 'Free-services Title Page',
                'value' => '<h2 class="title" data-aos="fade-up">
                                Monthly Withdrawal Program for <span class="color">October 2021</span>
                            </h2>
                            <p data-aos="fade-up" data-aos-delay="100">
                                Subscribe now to the monthly raffle program for a chance to win the service you want for free.
                            </p>'
            ],
            'key' => 'free-services.title.page',
        ]);

        Setting::create([
            'ar' => [
                'name' => 'Thank You Free Services Page',
                'value' => '<h2 class="title" data-aos="fade-up">
                                شكراً لك،، <br>
                                <span class="color">لقد تلقينا رسالتك</span>
                            </h2>
                            <p class="lead" data-aos="fade-up" data-aos-delay="100">
                                إذا كنت تحتاج إلى نص ينوب عن محتوى لم يتم إنشائه بعد، يمكنك استخدام هذه الأداة. بهذه الطريقة، يصبح بإمكان مصممي
                                الرسومات ومطوري المواقع، الخ التركيز على العناصر الرئيسية الأخرى
                            </p>'
            ],
            'en' => [
                'name' => 'Thank You Free Services Page',
                'value' => '<h2 class="title" data-aos="fade-up">
                                Thank you, <br>
                                <span class="color">We have received your Message</span>
                            </h2>
                            <p class="lead" data-aos="fade-up" data-aos-delay="100">
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Esse quos saepe obcaecati inventore ut quidem voluptatibus est. Ad fugit
                                laborum eaque delectus qui! Tempore ullam iusto, recusandae id voluptatum ipsam.
                            </p>'
            ],
            'key' => 'thanks.title.freeservices.page',
        ]);

        Setting::create([
            'ar' => [
                'name' => 'Thank You Free Services Page',
                'value' => '<h2 class="title" data-aos="fade-up">
                                شكراً لك،، <br>
                                <span class="color">لقد تلقينا تقييمك</span>
                            </h2>
                            <p class="lead" data-aos="fade-up" data-aos-delay="100">
                                إذا كنت تحتاج إلى نص ينوب عن محتوى لم يتم إنشائه بعد، يمكنك استخدام هذه الأداة. بهذه الطريقة، يصبح بإمكان مصممي
                                الرسومات ومطوري المواقع، الخ التركيز على العناصر الرئيسية الأخرى
                            </p>'
            ],
            'en' => [
                'name' => 'Thank You Free Services Page',
                'value' => '<h2 class="title" data-aos="fade-up">
                                Thank you, <br>
                                <span class="color">We have received your Review</span>
                            </h2>
                            <p class="lead" data-aos="fade-up" data-aos-delay="100">
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Esse quos saepe obcaecati inventore ut quidem voluptatibus est. Ad fugit
                                laborum eaque delectus qui! Tempore ullam iusto, recusandae id voluptatum ipsam.
                            </p>'
            ],
            'key' => 'thanks.title.rates.page',
        ]);

        Setting::create([
            'ar' => [
                'name' => 'Alert Offer NavBar web',
                'value' => '<span class="news__ribbon">متاح الآن</span>
                           <span class="news__text">عروض اليوم الوطني السعودي</span>'
            ],
            'en' => [
                'name' => 'Alert Offer NavBar web',
                'value' => '<span class="news__ribbon">Available Now</span>
                           <span class="news__text">Saudi National Day Offers</span>'
            ],
            'key' => 'alert.offer.navbar',
        ]);

        Setting::create([
            'ar' => [
                'name' => 'Hidden Alert Offer NavBar web',
                'value' => ''
            ],
            'en' => [
                'name' => 'Hidden Alert Offer NavBar web',
                'value' => ''
            ],
            'key' => 'hidden.alert.offer.navbar',
        ]);

        Setting::create([
            'ar' => [
                'name' => 'Notification Model web',
                'value' => '<div class="notification__text">
                                <span class="h6 color">
                                    الدكتورة/ دعاء حامد تتحدث عن
                                </span>
                                <h2 class="h3">
                                    أهمية جلسات شد الوجه والرقبة بتقنية الهايفو
                                </h2>
                                <p>
                                    تم إنشاء أداتنا الأبجدية لخدمة مصممي المواقع، ومدراء المواقع ومسوقين المحتوى. إذا كنت تحتاج إلى نص ينوب عن محتوى
                                    لم
                                    يتم إنشائه بعد، يمكنك استخدام هذه الأداة. بهذه الطريقة، يصبح بإمكان مصممي الرسومات ومطوري المواقع، الخ التركيز على
                                    العناصر الرئيسية الأخرى
                                </p>
                                <!-- actions -->
                                <div class="notification__actions">
                                    <a href="https://ram-main.medical-clinics.net/ar/book" class="btn btn-brand-primary">
                                        إحجز الآن
                                        <svg class="btn-icon">
                                            <use href="/web/assets2/images/icons/icons.svg#book"></use>
                                        </svg>
                                    </a>
                                    <a href="https://ram-main.medical-clinics.net/ar/doctors" class="btn btn-brand-primary-5">الملف الشخصي</a>
                                </div>
                                <!-- // actions -->
                            </div>'
            ],
            'en' => [
                'name' => 'Notification Model web',
                'value' => '<div class="notification__text">
                            <span class="h6 color">
                               Dr. Doaa Hamed talks about
                            </span>
                            <h2 class="h3">
                            The importance of face-lift sessions
                            Hifu neck technology
                            </h2>
                            <p>
                                Lorem ipsum dolor sit amet consectetur adipisicing elit. Distinctio cum sit iste soluta nemo, commodi illo magni
                                repellat
                                nostrum exercitationem. Doloremque voluptatum aliquid veritatis itaque assumenda.
                            </p>
                            <!-- actions -->
                            <div class="notification__actions">
                                <a href="https://ram-main.medical-clinics.net/ar/book" class="btn btn-brand-primary">
                                   Book Now
                                    <svg class="btn-icon">
                                        <use href="/web/assets2/images/icons/icons.svg#book"></use>
                                    </svg>
                                </a>
                                <a href="https://ram-main.medical-clinics.net/ar/doctors" class="btn btn-brand-primary-5">Doctor Profile</a>
                            </div>
                            <!-- // actions -->
                        </div>'
            ],
            'key' => 'notification.model.web',
        ]);

        Setting::create([
            'ar' => [
                'name' => 'titles header discounts page',
                'value' => '<h2 class="title" data-aos="fade-up">
                                خصومات حصرية <span class="color">لشركاء رام</span>
                            </h2>
                            <p data-aos="fade-up" data-aos-delay="100">
                                تم إنشاء أداتنا الأبجدية لخدمة مصممي المواقع، ومدراء المواقع ومسوقين المحتوى. إذا كنت تحتاج إلى نص ينوب عن محتوى لم يتم إنشائه
                                بعد.
                            </p>'
            ],
            'en' => [
                'name' => 'titles header discounts page',
                'value' => '<h2 class="title" data-aos="fade-up">
                                Exclusive discounts <span class="color">for Ram Partners</span>
                            </h2>
                            <p data-aos="fade-up" data-aos-delay="100">
                                You will live a unique experience during your treatment because we are pioneers in healthcare with a comfortable environment and
                                integrated care that we provide to you.
                            </p>'
            ],
            'key' => 'titlesheader.discounts.page',
        ]);

        Setting::create([
            'ar' => [
                'name' => 'titles discounts details page',
                'value' => 'الخصم متاح لجميع حاملي بطاقة البطاقة الاولى والأقرباء من الدرجة الاولى (ام - اب - اخ - اخت - زوج - زوجة - ابن -ابنة ).'
            ],
            'en' => [
                'name' => 'titles discounts details page',
                'value' => 'The discount is available to all first-degree card holders and first-degree relatives (mother - father - brother - sister -
                             husband - wife - son - daughter).'
            ],
            'key' => 'titles.details.discounts.page',
        ]);

        Setting::create([
            'ar' => [
                'name' => 'البريد اﻹلكترونى',
                'value' => 'info@ram.com'
            ],
            'en' => [
                'name' => 'Email',
                'value' => 'info@ram.com'
            ],
            'key' => 'common.email',
        ]);

        Setting::create([
            'ar' => [
                'name' => 'Notification Model Video Or Image web',
                'value' => '<!-- <picture>
                                <source srcset="/web/assets2/images/doctors/dr.webp" type="image/webp"><img src="/web/assets2/images/doctors/dr.jpg"
                                    draggable="false" loading="lazy" alt="doctor">
                            </picture> -->
                            <video src="/web/assets2/videos/reviews.mp4" preload="metadata" controls></video>'
            ],
            'en' => [
                'name' => 'Notification Model Video Or Image web',
                'value' => '<!-- <picture>
                            <source srcset="/web/assets2/images/doctors/dr.webp" type="image/webp"><img src="/web/assets2/images/doctors/dr.jpg"
                                draggable="false" loading="lazy" alt="doctor">
                        </picture> -->
                        <video src="/web/assets2/videos/reviews.mp4" preload="metadata" controls></video>'
            ],
            'key' => 'notification.model.videoOrimage.web',
        ]);

        Setting::create([
            'ar' => [
                'name' => 'Hidden Notification Model web',
                'value' => ''
            ],
            'en' => [
                'name' => 'Hidden Notification Model web',
                'value' => ''
            ],
            'key' => 'hidden.notification.model.web',
        ]);

        Setting::create([
            'ar' => [
                'name' => 'Slider Offer Logo web',
                'value' => '/web/assets2/images/offers/logo.jpg'
            ],
            'en' => [
                'name' => 'Slider Offer Logo web',
                'value' => '/web/assets2/images/offers/logo.jpg'
            ],
            'key' => 'slider.offer.logo.web',
        ]);

        Setting::create([
            'ar' => [
                'name' => 'About Page First Section',
                'value' => '<h2 class="title" data-aos="fade-up" data-aos-delay="100">
                                الجودة،، السلامة،، رضا العملاء،، <span class="color">وأخيراً المصداقية</span>
                            </h2>
                            <p class="lead" data-aos="fade-up">
                                نحن في عيادات رام نتخصص في الرعاية الطبية ونوفر خدمات ذات جودة عالية تحت سقف واحد بأحدث التقنيات المتقدمة في جميع التخصصات (
                                أسنان – جلدية – طبي ).
                            </p>
                            <p data-aos="fade-up">
                                في عيادات رام ستعيش تجربة فريدة من نوعها أثناء فترة علاجك لأننا رائدون في الرعاية الطبية بوجود بيئة مريحة ورعاية متكاملة
                                نوفرها لك، كما إننا نهدف الى بناء جسور الثقة مع جميع عملاؤنا عن طريق التعليم والتثقيف الصحي بالإضافة الى المصداقية.
                            </p>
                            <p data-aos="fade-up">
                                أخيراً، نود أن نقول لكم عملاؤنا بأن تتأكدوا أن مهاراتنا وقدراتنا لن تتوقف عن النمو لأننا في نهاية المطاف نحن نسعى لتحقيق أعلى
                                درجات الثقة والخدمة لكم.
                            </p>'
            ],
            'en' => [
                'name' => 'About Page First Section',
                'value' => '<h2 class="title" data-aos="fade-up" data-aos-delay="100">
                                Quality, Safety, Customer Satisfaction, <span class="color">and Finally Credibility.</span>
                            </h2>
                            <p class="lead" data-aos="fade-up">
                                We at Ram Clinics specialize in medical care and provide high quality services under one roof with the latest advanced
                                technologies in all specialties (dental - dermatology - medical).
                            </p>
                            <p data-aos="fade-up">
                                At Ram Clinics, you will live a unique experience during your treatment because we are pioneers in medical care with a
                                comfortable
                                environment and integrated care that we provide to you, and we aim to build bridges of trust with all our clients through
                                education and health education in addition to credibility.
                            </p>
                            <p data-aos="fade-up">
                                Finally, we would like to tell our clients to be assured that our skills and capabilities will not stop growing because in the
                                end
                                we strive to achieve the highest levels of trust and service for you.
                            </p>'
            ],
            'key' => 'about.page.first.section',
        ]);

        Setting::create([
            'ar' => [
                'name' => 'About Page Statistics Section',
                'value' => '<div class="statistic" data-aos="fade-up">
                                <div class="statistic__icon">
                                    <svg class="icon">
                                        <use href="/web/assets2/images/icons/icons.svg#country"></use>
                                    </svg>
                                </div>
                                <span class="small">أكثر من</span>
                                <h2 class="h3">20</h2>
                                <span class="lead">دولة</span>
                            </div>
                            <!-- // statistic -->
                            <!-- statistic -->
                            <div class="statistic" data-aos="fade-up" data-aos-delay="100">
                                <div class="statistic__icon">
                                    <svg class="icon">
                                        <use href="/web/assets2/images/icons/icons.svg#branch"></use>
                                    </svg>
                                </div>
                                <span class="small">أكثر من</span>
                                <h2 class="h3">50</h2>
                                <span class="lead">فرع</span>
                            </div>
                            <!-- // statistic -->
                            <!-- statistic -->
                            <div class="statistic" data-aos="fade-up" data-aos-delay="200">
                                <div class="statistic__icon">
                                    <svg class="icon">
                                        <use href="/web/assets2/images/icons/icons.svg#doctor"></use>
                                    </svg>
                                </div>
                                <span class="small">أكثر من</span>
                                <h2 class="h3">400</h2>
                                <span class="lead">طبيب</span>
                            </div>
                            <!-- // statistic -->
                            <!-- statistic -->
                            <div class="statistic" data-aos="fade-up" data-aos-delay="300">
                                <div class="statistic__icon">
                                    <svg class="icon">
                                        <use href="/web/assets2/images/icons/icons.svg#client"></use>
                                    </svg>
                                </div>
                                <span class="small">أكثر من</span>
                                <h2 class="h3">1000000</h2>
                                <span class="lead">عميل</span>
                            </div>'
            ],
            'en' => [
                'name' => 'About Page Statistics Section',
                'value' => ' <div class="statistic" data-aos="fade-up">
                                <div class="statistic__icon">
                                    <svg class="icon">
                                        <use href="/web/assets2/images/icons/icons.svg#country"></use>
                                    </svg>
                                </div>
                                <span class="small">More than</span>
                                <h2 class="h3">20</h2>
                                <span class="lead">Country</span>
                            </div>
                            <!-- // statistic -->
                            <!-- statistic -->
                            <div class="statistic" data-aos="fade-up" data-aos-delay="100">
                                <div class="statistic__icon">
                                    <svg class="icon">
                                        <use href="/web/assets2/images/icons/icons.svg#branch"></use>
                                    </svg>
                                </div>
                                <span class="small">More than</span>
                                <h2 class="h3">50</h2>
                                <span class="lead">Branch</span>
                            </div>
                            <!-- // statistic -->
                            <!-- statistic -->
                            <div class="statistic" data-aos="fade-up" data-aos-delay="200">
                                <div class="statistic__icon">
                                    <svg class="icon">
                                        <use href="/web/assets2/images/icons/icons.svg#doctor"></use>
                                    </svg>
                                </div>
                                <span class="small">More than</span>
                                <h2 class="h3">400</h2>
                                <span class="lead">Doctor</span>
                            </div>
                            <!-- // statistic -->
                            <!-- statistic -->
                            <div class="statistic" data-aos="fade-up" data-aos-delay="300">
                                <div class="statistic__icon">
                                    <svg class="icon">
                                        <use href="/web/assets2/images/icons/icons.svg#client"></use>
                                    </svg>
                                </div>
                                <span class="small">More than</span>
                                <h2 class="h3">1000000</h2>
                                <span class="lead">Client</span>
                            </div>'
            ],
            'key' => 'about.page.statistics.section',
        ]);

        Setting::create([
            'ar' => [
                'name' => 'About Page Vision Section',
                'value' => '<div class="about__block">
                                <div class="about__block-icons" data-aos="zoom-in">
                                    <svg class="icon">
                                        <use href="/web/assets2/images/icons/icons.svg#vision"></use>
                                    </svg>
                                </div>
                                <div class="about__block-text">
                                    <h2 class="h6" data-aos="fade-up" data-aos-delay="100">الرؤية</h2>
                                    <p data-aos="fade-up" data-aos-delay="200">
                                        الريادة فى تقديم خدمات الرعاية الطبية والتي تتوافق مع أعلى المعايير المحلية والدولية.
                                    </p>
                                </div>
                            </div>
                            <!-- // block -->
                            <!-- block -->
                            <div class="about__block">
                                <div class="about__block-icons" data-aos="zoom-in">
                                    <svg class="icon">
                                        <use href="/web/assets2/images/icons/icons.svg#message"></use>
                                    </svg>
                                </div>
                                <div class="about__block-text">
                                    <h2 class="h6" data-aos="fade-up" data-aos-delay="100">الرسالة</h2>
                                    <p data-aos="fade-up" data-aos-delay="200">
                                        تقديم الخدمات الطبية بجودة عالية من خلال الكوادر المؤهلة والتكنولوجيا المتقدمة وشبكة الفروع الواسعة.
                                    </p>
                                </div>
                            </div>
                            <!-- // block -->
                            <!-- block -->
                            <div class="about__block">
                                <div class="about__block-icons" data-aos="zoom-in">
                                    <svg class="icon">
                                        <use href="/web/assets2/images/icons/icons.svg#values"></use>
                                    </svg>
                                </div>
                                <div class="about__block-text">
                                    <h2 class="h6" data-aos="fade-up" data-aos-delay="100">القيم</h2>
                                    <p data-aos="fade-up" data-aos-delay="200">
                                        الجودة، السلامة، العمل الجماعي، رضا العملاء، رضا الموظفين، والمصداقية.
                                    </p>
                                </div>
                            </div>'
            ],
            'en' => [
                'name' => 'About Page Vision Section',
                'value' => '<div class="about__block">
                            <div class="about__block-icons" data-aos="zoom-in">
                                <svg class="icon">
                                    <use href="/web/assets2/images/icons/icons.svg#vision"></use>
                                </svg>
                            </div>
                            <div class="about__block-text">
                                <h2 class="h6" data-aos="fade-up" data-aos-delay="100">Vision</h2>
                                <p data-aos="fade-up" data-aos-delay="200">
                                    Leadership in providing medical care services that comply with the highest local and international standards.
                                </p>
                            </div>
                        </div>
                        <!-- // block -->
                        <!-- block -->
                        <div class="about__block">
                            <div class="about__block-icons" data-aos="zoom-in">
                                <svg class="icon">
                                    <use href="/web/assets2/images/icons/icons.svg#message"></use>
                                </svg>
                            </div>
                            <div class="about__block-text">
                                <h2 class="h6" data-aos="fade-up" data-aos-delay="100">Message</h2>
                                <p data-aos="fade-up" data-aos-delay="200">
                                    Providing high quality medical services through qualified cadres, advanced technology and a wide branch network.
                                </p>
                            </div>
                        </div>
                        <!-- // block -->
                        <!-- block -->
                        <div class="about__block">
                            <div class="about__block-icons" data-aos="zoom-in">
                                <svg class="icon">
                                    <use href="/web/assets2/images/icons/icons.svg#values"></use>
                                </svg>
                            </div>
                            <div class="about__block-text">
                                <h2 class="h6" data-aos="fade-up" data-aos-delay="100">Values</h2>
                                <p data-aos="fade-up" data-aos-delay="200">
                                    Quality, safety, teamwork, customer satisfaction, employee satisfaction, and credibility.
                                </p>
                            </div>
                        </div>'
            ],
            'key' => 'about.page.visions.section',
        ]);

        Setting::create([
            'ar' => [
                'name' => 'About Page TeamWork Section',
                'value' => '<p>
                                نخبة من الإستشاريين والإخصائيين في كافة التخصصات الطبية (أسنان – جلدية – طبية) سيقومون بخدمتكم. أغلب أعضاء فريقنا لديهم الماجستير
                                أو الدكتوراه من أعلى الجامعات الرائدةوالخبرة المميزة في كافة التخصصات الطبية.
                            </p>
                            <p>
                                تضم مجموعة عيادات رام أكثر من 400 طبيب وطبيبة من خلال شبكة واسعة من الفروع التي تضم 20 فرع داخل المملكة العربية السعودية والبحرين
                                والامارات ومصر. كل هذا الفريق يعمل من أجل أن يقدم لك أفضل علاج.
                            </p>'
            ],
            'en' => [
                'name' => 'About Page TeamWork Section',
                'value' => '<p>
                            An elite group of consultants and specialists in all medical specialties (dental - dermatology - medical) will serve you. Most of
                            our team members have masters or doctorate degrees from the top leading universities and distinguished experience in all medical
                            specialties.
                        </p>
                        <p>
                            Ram Clinics group includes more than 400 male and female doctors through a wide network of branches that includes 20 branches
                            within the Kingdom of Saudi Arabia, Bahrain, UAE and Egypt. All this team works to provide you with the best treatment.
                        </p>'
            ],
            'key' => 'about.page.teamwork.section',
        ]);

       

        Setting::create([
            'ar' => [
                'name' => 'About Page SaveHand one Section',
                'value' => '<p>
                                منذ 2007 تتخصص مجموعة رام في تقديم خدمات الرعاية الطبية بأحدث التقنيات العالمية في كافة التخصصات، حيث نعمل على إرضاء كافة
                                المرضى من خلال تقديم خدمات عالية الجودة على أيدي أمهر الكوادر الطبية بتكلفة مناسبة.
                            </p>'
            ],
            'en' => [
                'name' => 'About Page SaveHand one Section',
                'value' => ' <p>
                                Since 2007, Ram Group specializes in providing medical care services with the latest international technologies in all
                                specialties, where we work to satisfy all patients by providing high-quality services at the hands of the most skilled
                                medical staff at an appropriate cost.
                            </p>'
            ],
            'key' => 'about.page.savehand1.section',
        ]);

        Setting::create([
            'ar' => [
                'name' => 'About Page SaveHand two Section',
                'value' => '<p>
                                من خلال شبكة فروعنا الممتدة عبر المملكة العربية السعودية والبحرين لتصلوا الينا بسهولة و نعمل على توسيع شبكتنا لتغطي جميع
                                مناطق المملكة العربية السعودية والخليج العربي.
                            </p>'
            ],
            'en' => [
                'name' => 'About Page SaveHand two Section',
                'value' => '<p>
                                Through our network of branches extending across the Kingdom of Saudi Arabia and Bahrain to reach us easily and we are
                                working to expand our network to cover all regions of the Kingdom of Saudi Arabia and the Arabian Gulf.
                            </p>'
            ],
            'key' => 'about.page.savehand2.section',
        ]);

    }
}
