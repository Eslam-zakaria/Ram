<?php

namespace Modules\Page\Seeds;


use App\Constants\Genders;
use App\Constants\Templates;
use Illuminate\Database\Seeder;
use Modules\Page\Models\Page;

class PageSeeder extends Seeder
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
                'name'       => 'عن الشركة',
                'description'       => 'عن الشركة',
            ],
            'en' => [
                'name'       => 'About Company',
                'description'       => 'About Company',
            ],
            'slug' => 'page1',
            'image' => '/web/assets/images/product/02.jpg'
        ];


        Page::create($data);

    }
}
