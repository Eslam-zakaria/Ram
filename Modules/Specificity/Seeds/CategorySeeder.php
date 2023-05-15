<?php

namespace Modules\Specificity\Seeds;


use Illuminate\Database\Seeder;
use Modules\Specificity\Models\Category;

class CategorySeeder extends Seeder
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
                'name'       => 'اللامرئي (Invisalign) نتائج مرئية بعلاج غير مرئي.'
            ],
            'en' => [
                'name'       => 'Invisible (Invisalign) Visible results with invisible treatment.'
            ],
            'specificity_id' => 1
        ];

        Category::create($data);

        $data = [
            'ar' => [
                'name'       => 'تقويم الأسنان السريع Damon بدون خلع أسنان.'
            ],
            'en' => [
                'name'       => 'Damon rapid orthodontics without tooth extraction.'
            ],
            'specificity_id' => 1
        ];

        Category::create($data);

        $data = [
            'ar' => [
                'name'       => 'تقويم الأسنان الشفاف Crystal.'
            ],
            'en' => [
                'name'       => 'Crystal Orthodontics.'
            ],
            'specificity_id' => 1
        ];

        Category::create($data);

        $data = [
            'ar' => [
                'name'       => 'تقويم الأسنان للأطفال.'
            ],
            'en' => [
                'name'       => 'Children`s orthodontics.'
            ],
            'specificity_id' => 1
        ];

        Category::create($data);

        $data = [
            'ar' => [
                'name'       => 'تقويم الأسنان الجراحى.'
            ],
            'en' => [
                'name'       => 'Surgical orthodontics.'
            ],
            'specificity_id' => 1
        ];

        Category::create($data);

    }
}
