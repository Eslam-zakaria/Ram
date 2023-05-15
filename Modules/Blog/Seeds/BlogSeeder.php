<?php

namespace Modules\Blog\Seeds;


use Illuminate\Database\Seeder;
use Modules\Blog\Models\Blog;

class BlogSeeder extends Seeder
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
                'name'      => '1 معلومات حول تقويم الاسنان',
                'slug'      => 'معلومات-حول-تقويم-الاسنان-1',
                'content'   => 'تعريف تقويم الأسنان:هو أحد فروع طب الأسنان الذي يعنى بإصلاح و تعديل عيوب انتظام الأسنان و
                                                            اتساقها و معالجة عيوب الأطباق السني، و ذلك نتيجة لخلل في الأ'
            ],
            'en' => [
                'name'      => 'Information about Orthodontics',
                'slug'      => 'Information-about-Orthodontics-1',
                'content'   => "Lorem, ipsum dolor Lorem ipsum dolor, sit amet consectetur adipisicing elit. Nam error,
                                praesentium laboriosam repudiandae iusto quasi accusantium nihil non doloremque illum,
                                nisi aliquam doloribus veritatis ducimus suscipit debitis dolores necessitatibus impedit."
            ],
            'category_id' => 1,
            'image' => '/web/assets/images/blog/1.jpg'

        ];

        Blog::create($data);

        $data = [
            'ar' => [
                'name'      => '2معلومات حول تقويم الاسنان',
                'slug'      => 'معلومات-حوسسسل-تقويم-الاسنان-2',
                'content'   => 'تعريف تقويم الأسنان:هو أحد فروع طب الأسنان الذي يعنى بإصلاح و تعديل عيوب انتظام الأسنان و
                                                            اتساقها و معالجة عيوب الأطباق السني، و ذلك نتيجة لخلل في الأ'
            ],
            'en' => [
                'name'      => 'Information about Orthodontics',
                'slug'      => 'Information-about-Orthodontics-2',
                'content'   => "Lorem, ipsum dolor Lorem ipsum dolor, sit amet consectetur adipisicing elit. Nam error,
                                praesentium laboriosam repudiandae iusto quasi accusantium nihil non doloremque illum,
                                nisi aliquam doloribus veritatis ducimus suscipit debitis dolores necessitatibus impedit."
            ],
            'category_id' => 1,
            'image' => '/web/assets/images/blog/2.jpg'

        ];

        Blog::create($data);

        $data = [
            'ar' => [
                'name'      => 'معلومات حول تقويم الاسنان3',
                'slug'      => '-٢معلومات-حوسسسل-تقويم-الاسنان-3',
                'content'   => 'تعريف تقويم الأسنان:هو أحد فروع طب الأسنان الذي يعنى بإصلاح و تعديل عيوب انتظام الأسنان و
                                                            اتساقها و معالجة عيوب الأطباق السني، و ذلك نتيجة لخلل في الأ'
            ],
            'en' => [
                'name'      => 'Information about Orthodontics',
                'slug'      => 'Information-about-Orthodontics-3',
                'content'   => "Lorem, ipsum dolor Lorem ipsum dolor, sit amet consectetur adipisicing elit. Nam error,
                                praesentium laboriosam repudiandae iusto quasi accusantium nihil non doloremque illum,
                                nisi aliquam doloribus veritatis ducimus suscipit debitis dolores necessitatibus impedit."
            ],
            'category_id' => 1,
            'image' => '/web/assets/images/blog/3.jpg'

        ];

        Blog::create($data);


        $data = [
            'ar' => [
                'name'      => '4معلومات حول تقويم الاسنان',
                'slug'      => '-٢معلومات-حوسسسل-تقويم-الاسنان٣',
                'content'   => 'تعريف تقويم الأسنان:هو أحد فروع طب الأسنان الذي يعنى بإصلاح و تعديل عيوب انتظام الأسنان و
                                                            اتساقها و معالجة عيوب الأطباق السني، و ذلك نتيجة لخلل في الأ'
            ],
            'en' => [
                'name'      => 'Information about Orthodontics',
                'slug'      => 'Information-about-Orthodontics-4',
                'content'   => "Lorem, ipsum dolor Lorem ipsum dolor, sit amet consectetur adipisicing elit. Nam error,
                                praesentium laboriosam repudiandae iusto quasi accusantium nihil non doloremque illum,
                                nisi aliquam doloribus veritatis ducimus suscipit debitis dolores necessitatibus impedit."
            ],
            'category_id' => 1,
            'image' => '/web/assets/images/blog/4.jpg'

        ];

        Blog::create($data);


        $data = [
            'ar' => [
                'name'      => 'معلومات حول تقويم الاسنان5',
                'slug'      => '-٢م٣علومات-حوسسسل-تقويم-الاسنان5',
                'content'   => 'تعريف تقويم الأسنان:هو أحد فروع طب الأسنان الذي يعنى بإصلاح و تعديل عيوب انتظام الأسنان و
                                                            اتساقها و معالجة عيوب الأطباق السني، و ذلك نتيجة لخلل في الأ'
            ],
            'en' => [
                'name'      => 'Information about Orthodontics',
                'slug'      => 'Information-about-Orthodontics-34',
                'content'   => "Lorem, ipsum dolor Lorem ipsum dolor, sit amet consectetur adipisicing elit. Nam error,
                                praesentium laboriosam repudiandae iusto quasi accusantium nihil non doloremque illum,
                                nisi aliquam doloribus veritatis ducimus suscipit debitis dolores necessitatibus impedit."
            ],
            'category_id' => 1,
            'image' => '/web/assets/images/blog/1.jpg'

        ];

        Blog::create($data);


        $data = [
            'ar' => [
                'name'      => 'معلومات حول تقويم الاسنان66',
                'slug'      => '-٢م٣علوما٣ت-حوسسسل-تقويم-الاسنان66',
                'content'   => 'تعريف تقويم الأسنان:هو أحد فروع طب الأسنان الذي يعنى بإصلاح و تعديل عيوب انتظام الأسنان و
                                                            اتساقها و معالجة عيوب الأطباق السني، و ذلك نتيجة لخلل في الأ'
            ],
            'en' => [
                'name'      => 'Information about Orthodontics',
                'slug'      => 'Information-about-Orthodontics-44',
                'content'   => "Lorem, ipsum dolor Lorem ipsum dolor, sit amet consectetur adipisicing elit. Nam error,
                                praesentium laboriosam repudiandae iusto quasi accusantium nihil non doloremque illum,
                                nisi aliquam doloribus veritatis ducimus suscipit debitis dolores necessitatibus impedit."
            ],
            'category_id' => 1,
            'image' => '/web/assets/images/blog/2.jpg'

        ];

        Blog::create($data);
    }
}
