<?php

namespace Modules\Casing\Seeds;


use Illuminate\Database\Seeder;
use Modules\Casing\Models\CasingCategory;

class CasingCategorySeeder extends Seeder
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
                'name'       => ' حالات اسنان'
            ],
            'en' => [
                'name'       => 'Dental Casings'
            ],
        ];

        CasingCategory::create($data);


        $data = [
            'ar' => [
                'name'       => 'حالات تجميليه'
            ],
            'en' => [
                'name'       => 'derma Casings'
            ],
        ];

        CasingCategory::create($data);

        $data = [
            'ar' => [
                'name'       => 'حالات طبيه'
            ],
            'en' => [
                'name'       => 'medical Casings'
            ],
        ];

        CasingCategory::create($data);
    }
}