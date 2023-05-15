<?php

namespace Modules\Discount\Seeds;

use App\Constants\Statuses;
use Illuminate\Database\Seeder;
use Modules\Discount\Models\Discount;

class DiscountSeeder extends Seeder
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
                'name'      => 'German porcelain fittings for one tooth',
                'description'   => 'تعريف تقويم الأسنان:هو أحد فروع طب الأسنان الذي يعنى بإصلاح و تعديل عيوب انتظام الأسنان و
                                                            اتساقها و معالجة عيوب الأطباق السني، و ذلك نتيجة لخلل في الأ'
            ],
            'en' => [
                'name'      => 'German porcelain fittings for one tooth',
                'description'   => "Lorem, ipsum dolor Lorem ipsum dolor, sit amet consectetur adipisicing elit. Nam error,
                                praesentium laboriosam repudiandae iusto quasi accusantium nihil non doloremque illum,
                                nisi aliquam doloribus veritatis ducimus suscipit debitis dolores necessitatibus impedit."
            ],
            'image' => '/web/assets/images/partners/partners-discount/01.webp',
            'status' => Statuses::ACTIVE,
            'card_id' => 1,
            'category_id' => 1,
            'price' => 100
        ];

        Discount::create($data);
    }
}
