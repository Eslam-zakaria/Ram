<?php

namespace Modules\Blog\Seeds;


use Illuminate\Database\Seeder;
use Modules\Blog\Models\BlogCategory;

class BlogCategorySeeder extends Seeder
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
                'name'       => 'تخصص١'
            ],
            'en' => [
                'name'       => 'category 1'
            ],
        ];

        BlogCategory::create($data);

        $data = [
            'ar' => [
                'name'       => 'تخصص ٢'
            ],
            'en' => [
                'name'       => 'category 2'
            ],
        ];

        BlogCategory::create($data);
    }
}
