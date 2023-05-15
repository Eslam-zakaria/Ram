<?php

namespace Modules\Offer\Seeds;


use Illuminate\Database\Seeder;
use Modules\Offer\Models\Offer;

class OfferSeeder extends Seeder
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
                'name'       => 'تبييض الأسنان'
            ],
            'en' => [
                'name'       => 'Teeth whitening'
            ],
            'price' => '1200',
            'service_id' => 1,
            'branche_id' => 1,
            'image' => '/web/assets/images/offers/wf-bh.jpg'
        ];

        Offer::create($data);

    }
}
