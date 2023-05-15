<?php

namespace Modules\Specificity\Seeds;


use Illuminate\Database\Seeder;
use Modules\Specificity\Models\Specificity;

class SpecificitySeeder extends Seeder
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
                'name'       => 'جراحة وزراعة الأسنان',
                'description'       => 'في عيادات رام ستعيش تجربة فريدة من نوعها أثناء فترة علاجك لأننا رائدون في الرعاية الصحية بوجود بيئة مريحة ورعاية متكاملة نوفرها لك، كما إننا نهدف الى بناء جسور الثقة مع جميع عملاؤنا عن طريق التعليم والتثقيف الصحي بالإضافة الى المصداقية'
            ],
            'en' => [
                'name'       => 'Dental Surgery and Implants',
                'description'       => 'At Ram Clinics, you will live a unique experience during your treatment because we are pioneers in healthcare with a comfortable environment and integrated care that we provide to you, and we aim to build bridges of trust with all our clients through education and health education in addition to credibility',
            ],
            'icon' => '/web/assets/images/services/shutterstock_1920734900.jpg',
            'image' => '/web/assets/images/services/shutterstock_1920734900.jpg',
            'service_id' => 1
        ];

        Specificity::create($data);

        $data = [
            'ar' => [
                'name'       => 'طب وتجميل الأسنان',
                'description'       => 'في عيادات رام ستعيش تجربة فريدة من نوعها أثناء فترة علاجك لأننا رائدون في الرعاية الصحية بوجود بيئة مريحة ورعاية متكاملة نوفرها لك، كما إننا نهدف الى بناء جسور الثقة مع جميع عملاؤنا عن طريق التعليم والتثقيف الصحي بالإضافة الى المصداقية'
            ],
            'en' => [
                'name'       => 'Dentistry and Cosmetic Dentistry',
                'description'       => 'At Ram Clinics, you will live a unique experience during your treatment because we are pioneers in healthcare with a comfortable environment and integrated care that we provide to you, and we aim to build bridges of trust with all our clients through education and health education in addition to credibility',
            ],
            'icon' => '/web/assets/images/services/shutterstock_1920734900.jpg',
            'image' => '/web/assets/images/services/shutterstock_1920734900.jpg',
            'service_id' => 1
        ];

        Specificity::create($data);

        $data = [
            'ar' => [
                'name'       => 'تقويم الأسنان',
                'description'       => 'في عيادات رام ستعيش تجربة فريدة من نوعها أثناء فترة علاجك لأننا رائدون في الرعاية الصحية بوجود بيئة مريحة ورعاية متكاملة نوفرها لك، كما إننا نهدف الى بناء جسور الثقة مع جميع عملاؤنا عن طريق التعليم والتثقيف الصحي بالإضافة الى المصداقية'
            ],
            'en' => [
                'name'       => 'Orthodontics',
                'description'       => 'At Ram Clinics, you will live a unique experience during your treatment because we are pioneers in healthcare with a comfortable environment and integrated care that we provide to you, and we aim to build bridges of trust with all our clients through education and health education in addition to credibility',
            ],
            'icon' => '/web/assets/images/services/shutterstock_1920734900.jpg',
            'image' => '/web/assets/images/services/shutterstock_1920734900.jpg',
            'service_id' => 1
        ];

        Specificity::create($data);

        $data = [
            'ar' => [
                'name'       => 'طب أسنان الأطفال',
                'description'       => 'في عيادات رام ستعيش تجربة فريدة من نوعها أثناء فترة علاجك لأننا رائدون في الرعاية الصحية بوجود بيئة مريحة ورعاية متكاملة نوفرها لك، كما إننا نهدف الى بناء جسور الثقة مع جميع عملاؤنا عن طريق التعليم والتثقيف الصحي بالإضافة الى المصداقية'
            ],
            'en' => [
                'name'       => 'Pediatric Dentistry',
                'description'       => 'At Ram Clinics, you will live a unique experience during your treatment because we are pioneers in healthcare with a comfortable environment and integrated care that we provide to you, and we aim to build bridges of trust with all our clients through education and health education in addition to credibility',
            ],
            'icon' => '/web/assets/images/services/shutterstock_1920734900.jpg',
            'image' => '/web/assets/images/services/shutterstock_1920734900.jpg',
            'service_id' => 1
        ];

        Specificity::create($data);

        $data = [
            'ar' => [
                'name'       => 'علاج وتجميل اللثة',
                'description'       => 'في عيادات رام ستعيش تجربة فريدة من نوعها أثناء فترة علاجك لأننا رائدون في الرعاية الصحية بوجود بيئة مريحة ورعاية متكاملة نوفرها لك، كما إننا نهدف الى بناء جسور الثقة مع جميع عملاؤنا عن طريق التعليم والتثقيف الصحي بالإضافة الى المصداقية'
            ],
            'en' => [
                'name'       => 'Gum Treatment and Beautification',
                'description'       => 'At Ram Clinics, you will live a unique experience during your treatment because we are pioneers in healthcare with a comfortable environment and integrated care that we provide to you, and we aim to build bridges of trust with all our clients through education and health education in addition to credibility',
            ],
            'icon' => '/web/assets/images/services/shutterstock_1920734900.jpg',
            'image' => '/web/assets/images/services/shutterstock_1920734900.jpg',
            'service_id' => 1
        ];

        Specificity::create($data);

        $data = [
            'ar' => [
                'name'       => 'صحة الفم والأسنان',
                'description'       => 'في عيادات رام ستعيش تجربة فريدة من نوعها أثناء فترة علاجك لأننا رائدون في الرعاية الصحية بوجود بيئة مريحة ورعاية متكاملة نوفرها لك، كما إننا نهدف الى بناء جسور الثقة مع جميع عملاؤنا عن طريق التعليم والتثقيف الصحي بالإضافة الى المصداقية'
            ],
            'en' => [
                'name'       => 'The Mouth and Teeth`s Health',
                'description'       => 'At Ram Clinics, you will live a unique experience during your treatment because we are pioneers in healthcare with a comfortable environment and integrated care that we provide to you, and we aim to build bridges of trust with all our clients through education and health education in addition to credibility',
            ],
            'icon' => '/web/assets/images/services/shutterstock_1920734900.jpg',
            'image' => '/web/assets/images/services/shutterstock_1920734900.jpg',
            'service_id' => 1
        ];

        Specificity::create($data);

        $data = [
            'ar' => [
                'name'       => ' علاج جذور الاسنان',
                'description'       => 'في عيادات رام ستعيش تجربة فريدة من نوعها أثناء فترة علاجك لأننا رائدون في الرعاية الصحية بوجود بيئة مريحة ورعاية متكاملة نوفرها لك، كما إننا نهدف الى بناء جسور الثقة مع جميع عملاؤنا عن طريق التعليم والتثقيف الصحي بالإضافة الى المصداقية'
            ],
            'en' => [
                'name'       => 'Endodontics',
                'description'       => 'At Ram Clinics, you will live a unique experience during your treatment because we are pioneers in healthcare with a comfortable environment and integrated care that we provide to you, and we aim to build bridges of trust with all our clients through education and health education in addition to credibility',
            ],
            'icon' => '/web/assets/images/services/shutterstock_1920734900.jpg',
            'image' => '/web/assets/images/services/shutterstock_1920734900.jpg',
            'service_id' => 1
        ];

        Specificity::create($data);

    }
}
