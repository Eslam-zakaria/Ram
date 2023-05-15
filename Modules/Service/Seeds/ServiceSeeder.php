<?php

namespace Modules\Service\Seeds;


use Illuminate\Database\Seeder;
use Modules\Service\Models\Service;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            'ar' => [
                'name'       => 'اللأسنان',
                'slug'       => 'اللأسنان',
                'description' => '
                <h2 class="h3 title" data-aos="fade-up">
                    نتميز <span class="color">بالجودة العالية وأحدث التقنيات المتقدمة</span>
                    في جميع تخصصات طب وتجميل الأسنان
                </h2>
                <p class="lead" data-aos="fade-up" data-aos-delay="100">
                    ستعيش تجربة فريدة أثناء علاجك لأننا رواد في الرعاية الصحية مع بيئة مريحة و
                    الرعاية المتكاملة التي نقدمها لك.
                </p>
                <p data-aos="fade-up" data-aos-delay="200">
                    في عيادات رام ستعيش تجربة فريدة من نوعها أثناء فترة علاجك لأننا رائدون في الرعاية الصحية بوجود بيئة مريحة ورعاية متكاملة نوفرها
                    لك، كما إننا نهدف الى بناء جسور الثقة مع جميع عملاؤنا عن طريق التعليم والتثقيف الصحي بالإضافة الى المصداقية.
                </p>
                    ',
            ],
            'en' => [
                'name'       => 'Dental',
                'slug'       => 'Dental',
                'description' => '
                <h2 class="h3 title" data-aos="fade-up">
                    We are distinguished by <span class="color">high quality and the latest advanced technologies</span>
                    In all specialties of dentistry and cosmetic dentistry
                </h2>
                <p class="lead" data-aos="fade-up" data-aos-delay="100">
                    You will live a unique experience during your treatment because we are pioneers in healthcare with a comfortable environment and
                    integrated care that we provide to you.
                </p>
                <p data-aos="fade-up" data-aos-delay="200">
                    At Ram Clinics, you will live a unique experience during your treatment because we are pioneers in healthcare with a comfortable
                    environment and integrated care that we provide to you, and we aim to build bridges of trust with all our clients through
                    education and health education in addition to credibility
                </p>
                ',
            ],
            'icon' => 'dental',
            'image' => '/web/assets/images/services/dental.jpg'
        ];

        Service::create($data);

        $data = [
            'ar' => [
                'name'       => 'الجلدية',
                'slug'       => 'الجلدية',
                'description' => '
                <h2 class="h3 title" data-aos="fade-up">
                    نتميز <span class="color">بالجودة العالية وأحدث التقنيات المتقدمة</span>
                    في جميع تخصصات طب وتجميل الأسنان
                </h2>
                <p class="lead" data-aos="fade-up" data-aos-delay="100">
                    ستعيش تجربة فريدة أثناء علاجك لأننا رواد في الرعاية الصحية مع بيئة مريحة و
                    الرعاية المتكاملة التي نقدمها لك.
                </p>
                <p data-aos="fade-up" data-aos-delay="200">
                    في عيادات رام ستعيش تجربة فريدة من نوعها أثناء فترة علاجك لأننا رائدون في الرعاية الصحية بوجود بيئة مريحة ورعاية متكاملة نوفرها
                    لك، كما إننا نهدف الى بناء جسور الثقة مع جميع عملاؤنا عن طريق التعليم والتثقيف الصحي بالإضافة الى المصداقية.
                </p>
                    ',
            ],
            'en' => [
                'name'       => 'Derma',
                'slug'       => 'Derma',
                'description' => '
                <h2 class="h3 title" data-aos="fade-up">
                    We are distinguished by <span class="color">high quality and the latest advanced technologies</span>
                    In all specialties of dentistry and cosmetic dentistry
                </h2>
                <p class="lead" data-aos="fade-up" data-aos-delay="100">
                    You will live a unique experience during your treatment because we are pioneers in healthcare with a comfortable environment and
                    integrated care that we provide to you.
                </p>
                <p data-aos="fade-up" data-aos-delay="200">
                    At Ram Clinics, you will live a unique experience during your treatment because we are pioneers in healthcare with a comfortable
                    environment and integrated care that we provide to you, and we aim to build bridges of trust with all our clients through
                    education and health education in addition to credibility
                </p>
                ',
            ],
            'icon' => 'derma',
            'image' => '/web/assets/images/services/derma.jpg'
        ];

        Service::create($data);

        $data = [
            'ar' => [
                'name'       => 'الطبية',
                'slug'       => 'الطبية',
                'description' => '
                <h2 class="h3 title" data-aos="fade-up">
                    نتميز <span class="color">بالجودة العالية وأحدث التقنيات المتقدمة</span>
                    في جميع تخصصات طب وتجميل الأسنان
                </h2>
                <p class="lead" data-aos="fade-up" data-aos-delay="100">
                    ستعيش تجربة فريدة أثناء علاجك لأننا رواد في الرعاية الصحية مع بيئة مريحة و
                    الرعاية المتكاملة التي نقدمها لك.
                </p>
                <p data-aos="fade-up" data-aos-delay="200">
                    في عيادات رام ستعيش تجربة فريدة من نوعها أثناء فترة علاجك لأننا رائدون في الرعاية الصحية بوجود بيئة مريحة ورعاية متكاملة نوفرها
                    لك، كما إننا نهدف الى بناء جسور الثقة مع جميع عملاؤنا عن طريق التعليم والتثقيف الصحي بالإضافة الى المصداقية.
                </p>
                    ',
            ],
            'en' => [
                'name'       => 'Medical',
                'slug'       => 'Medical',
                'description' => '
                <h2 class="h3 title" data-aos="fade-up">
                    We are distinguished by <span class="color">high quality and the latest advanced technologies</span>
                    In all specialties of dentistry and cosmetic dentistry
                </h2>
                <p class="lead" data-aos="fade-up" data-aos-delay="100">
                    You will live a unique experience during your treatment because we are pioneers in healthcare with a comfortable environment and
                    integrated care that we provide to you.
                </p>
                <p data-aos="fade-up" data-aos-delay="200">
                    At Ram Clinics, you will live a unique experience during your treatment because we are pioneers in healthcare with a comfortable
                    environment and integrated care that we provide to you, and we aim to build bridges of trust with all our clients through
                    education and health education in addition to credibility
                </p>
                ',
            ],
            'icon' => 'medical',
            'image' => '/web/assets/images/services/medical.jpg'
        ];

        Service::create($data);
    }
}
