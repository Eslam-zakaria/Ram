<?php

namespace Modules\Casing\Seeds;

use App\Constants\Statuses;
use Illuminate\Database\Seeder;
use Modules\Casing\Models\Casing;

class CasingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            'image_before' => '/web/assets/images/slider/slider-1.jpg',
            'image_after' => '/web/assets/images/slider/slider-2.jpg',
            'doctor_id' => 1,
            'category_id' => 1,
            'status' => Statuses::ACTIVE,
        ];

        Casing::create($data);
    }
}