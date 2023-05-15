<?php

namespace Modules\Offer\Seeds;


use Illuminate\Database\Seeder;
use Modules\Offer\Models\OfferBranche;

class OfferBrancheSeeder extends Seeder
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
                'name'  => 'السعودية',
                'slug'  => 'السعودية',
                'desc_offer'  => 'عروض الجمعة البيضاء',
                'currency'  => 'ريال سعودى'
            ],
            'en' => [
                'name'  => 'Saudi Arabia',
                'slug'  => 'Saudi-Arabia',
                'desc_offer'  => 'Black Friday Offers',
                'currency'  => 'SR'
            ],
            'image' => '/web/assets/images/offers/wf-ksa.jpg'
        ];

        OfferBranche::create($data);

        $data = [
            'ar' => [
                'name'  => 'جدة',
                'slug'  => 'جدة',
                'desc_offer'  => 'عروض الجمعة البيضاء',
                'currency'    => 'ريال سعودى'
            ],
            'en' => [
                'name'  => 'Jeddah',
                'slug'   => 'Jeddah',
                'desc_offer'  => 'Black Friday Offers',
                'currency'    => 'SR'
            ],
            'image' => '/web/assets/images/offers/wf-ksa.jpg'
        ];

        OfferBranche::create($data);
    }
}
