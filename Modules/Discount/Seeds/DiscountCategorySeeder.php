<?php

namespace Modules\Discount\Seeds;


use Illuminate\Database\Seeder;
use Modules\Discount\Models\DiscountCategory;

class DiscountCategorySeeder extends Seeder
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
                'name'       => 'خصومات اسنان'
            ],
            'en' => [
                'name'       => 'Dental Discounts'
            ],
            'slug' => 'dental'
        ];

        $cat = DiscountCategory::create($data);

        $cat->branches()->attach([1, 2]);


        $data = [
            'ar' => [
                'name'       => 'خصومات تجميليه'
            ],
            'en' => [
                'name'       => 'derma Discounts'
            ],
            'slug' => 'derma',
        ];

        $cat = DiscountCategory::create($data);


        $cat->branches()->attach([1, 2]);

        $data = [
            'ar' => [
                'name'       => 'خصومات طبيه'
            ],
            'en' => [
                'name'       => 'medical Discounts'
            ],
            'slug' => 'medical',
        ];

        $cat = DiscountCategory::create($data);

        $cat->branches()->attach([1, 2]);
    }
}
