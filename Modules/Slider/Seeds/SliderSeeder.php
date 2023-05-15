<?php

namespace Modules\Slider\Seeds;


use Illuminate\Database\Seeder;
use Modules\Slider\Models\Slider;

class SliderSeeder extends Seeder
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
                'description'       => '<h1 data-aos="fade-up" data-aos-delay="300">
                                        رمز <span class="color">الثقة</span> في الرعاية الطبية
                                    </h1>
                                    <p class="lead" data-aos="fade-up" data-aos-delay="400">
                                        نوفر خدمات ذات جودة عالية تحت سقف واحد بأحدث التقنيات المتقدمة في جميع التخصصات ( أسنان – جلدية – طبي ).
                                    </p>',
            ],
            'en' => [
                'description'       => '<h1 data-aos="fade-up" data-aos-delay="300">
                                            A Symbol of <span class="color">trust</span> in Medical Care.
                                        </h1>
                                        <p class="lead" data-aos="fade-up" data-aos-delay="400">
                                            We provide high quality services under one roof with the latest advanced technologies in all specialties (dental -
                                            dermatology - medical)
                                        </p>',
            ],
            'image' => '/web/assets/images/slider/slider-1.webp'
        ];

        Slider::create($data);

        $data = [
            'ar' => [
                'description'       => '<h1 data-aos="fade-up" data-aos-delay="300">
                                            نوفر لكم <span class="color">أفضل</span> خدمات الأسنان الجلدية والطبية
                                        </h1>
                                        <p class="lead" data-aos="fade-up" data-aos-delay="400">
                                            نوفر خدمات ذات جودة عالية تحت سقف واحد بأحدث التقنيات المتقدمة في جميع التخصصات ( أسنان – جلدية – طبي ).
                                        </p>',
            ],
            'en' => [
                'description'       => '<h1 data-aos="fade-up" data-aos-delay="300">
                                            We provide <span class="color">the best</span> Dental, Derma and Medical services.
                                        </h1>
                                        <p class="lead" data-aos="fade-up" data-aos-delay="400">
                                            We provide high quality services under one roof with the latest advanced technologies in all specialties (dental -
                                            dermatology - medical)
                                        </p>',
            ],
            'image' => '/web/assets/images/slider/slider-2.webp'
        ];


        Slider::create($data);

        $data = [
            'ar' => [
                    'description'       => '<h1 data-aos="fade-up" data-aos-delay="300">
                                            إستمتعي <span class="color">بالجمال</span> الآن ومدى الحياة
                                        </h1>
                                        <p class="lead" data-aos="fade-up" data-aos-delay="400">
                                            نوفر خدمات ذات جودة عالية تحت سقف واحد بأحدث التقنيات المتقدمة في جميع التخصصات ( أسنان – جلدية – طبي ).
                                        </p>',
            ],
            'en' => [
                'description'       => '<h1 data-aos="fade-up" data-aos-delay="300">
                                            Feel the <span class="color">Beauty</span> now and forever.
                                        </h1>
                                        <p class="lead" data-aos="fade-up" data-aos-delay="400">
                                            We provide high quality services under one roof with the latest advanced technologies in all specialties (dental -
                                            dermatology - medical)
                                        </p>',
            ],
            'image' => '/web/assets/images/slider/slider-3.webp'
        ];


        Slider::create($data);
    }
}
