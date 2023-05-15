<?php

namespace Modules\Discount\Seeds;

use App\Constants\Statuses;
use Illuminate\Database\Seeder;
use Modules\Discount\Models\Card;
use Modules\Discount\Models\Discount;

class CardSeeder extends Seeder
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
                'name'      => '1 كارت',
                'description'   => 'تعريف تقويم الأسنان:هو أحد فروع طب الأسنان الذي يعنى بإصلاح و تعديل عيوب انتظام الأسنان و
                                                            اتساقها و معالجة عيوب الأطباق السني، و ذلك نتيجة لخلل في الأ'
            ],
            'en' => [
                'name'      => 'Card',
                'description'   => "Lorem, ipsum dolor Lorem ipsum dolor, sit amet consectetur adipisicing elit. Nam error,
                                praesentium laboriosam repudiandae iusto quasi accusantium nihil non doloremque illum,
                                nisi aliquam doloribus veritatis ducimus suscipit debitis dolores necessitatibus impedit."
            ],
            'image' => '/web/assets/images/partners/partners-discount/01.webp',
            'status' => Statuses::ACTIVE,
        ];

        Card::create($data);

        $data = [
            'ar' => [
                'name'      => '2كارت',
                'description'   => 'تعريف تقويم الأسنان:هو أحد فروع طب الأسنان الذي يعنى بإصلاح و تعديل عيوب انتظام الأسنان و
                                                            اتساقها و معالجة عيوب الأطباق السني، و ذلك نتيجة لخلل في الأ'
            ],
            'en' => [
                'name'      => 'Card 2',
                'description'   => "Lorem, ipsum dolor Lorem ipsum dolor, sit amet consectetur adipisicing elit. Nam error,
                                praesentium laboriosam repudiandae iusto quasi accusantium nihil non doloremque illum,
                                nisi aliquam doloribus veritatis ducimus suscipit debitis dolores necessitatibus impedit."
            ],
            'image' => '/web/assets/images/partners/partners-discount/01.webp',
            'status' => Statuses::ACTIVE,
        ];

        Card::create($data);

        $data = [
            'ar' => [
                'name'      => 'كارت3',
                'description'   => 'تعريف تقويم الأسنان:هو أحد فروع طب الأسنان الذي يعنى بإصلاح و تعديل عيوب انتظام الأسنان و
                                                            اتساقها و معالجة عيوب الأطباق السني، و ذلك نتيجة لخلل في الأ'
            ],
            'en' => [
                'name'      => 'Card 3',
                'description'   => "Lorem, ipsum dolor Lorem ipsum dolor, sit amet consectetur adipisicing elit. Nam error,
                                praesentium laboriosam repudiandae iusto quasi accusantium nihil non doloremque illum,
                                nisi aliquam doloribus veritatis ducimus suscipit debitis dolores necessitatibus impedit."
            ],
            'image' => '/web/assets/images/partners/partners-discount/01.webp',
            'status' => Statuses::ACTIVE,
        ];

        Card::create($data);
    }
}
