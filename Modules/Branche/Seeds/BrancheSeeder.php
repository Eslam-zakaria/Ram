<?php

namespace Modules\Branche\Seeds;


use Illuminate\Database\Seeder;
use Modules\Branche\Models\Branche;

class BrancheSeeder extends Seeder
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
                'name'       => 'الخبر - حي الحزام'
            ],
            'en' => [
                'name'       => 'Al Khobar - Al Hizam District'
            ],
            'phone' => '0533333333',
            'location' => 'https://goo.gl/maps/zM3eE5H1y54qRoyw7',
            'image' => '/web/assets/images/branches/1.jpg',
            'country_id' => 2
        ];

        $branche = Branche::create($data);

        $branche->services()->attach([1]);

        $data = [
            'ar' => [
                'name'       => 'شمال الخبر'
            ],
            'en' => [
                'name'       => 'north of khobar'
            ],
            'phone' => '0533333333',
            'location' => 'https://goo.gl/maps/zM3eE5H1y54qRoyw7',
            'image' => '/web/assets/images/branches/1.jpg',
            'country_id' => 2
        ];

        $branche2 = Branche::create($data);

        $branche2->services()->attach([1]);

        $data = [
            'ar' => [
                'name'       => 'الدوحة'
            ],
            'en' => [
                'name'       => 'Doha'
            ],
            'phone' => '0533333333',
            'location' => 'https://goo.gl/maps/zM3eE5H1y54qRoyw7',
            'image' => '/web/assets/images/branches/1.jpg',
            'country_id' => 3
        ];

        $branche3 = Branche::create($data);

        $branche3->services()->attach([1]);

        $data = [
            'ar' => [
                'name'       => 'حى القصور'
            ],
            'en' => [
                'name'       => 'Al-Qusour district'
            ],
            'phone' => '0533333333',
            'location' => 'https://goo.gl/maps/zM3eE5H1y54qRoyw7',
            'image' => '/web/assets/images/branches/1.jpg',
            'country_id' => 3
        ];

        $branche4 = Branche::create($data);

        $branche4->services()->attach([1]);
    }
}
