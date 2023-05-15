<?php

namespace Modules\Partner\Seeds;


use Illuminate\Database\Seeder;
use Modules\Partner\Models\Partner;

class PartnerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            'image' => '/web/assets/images/partners/1.webp'
        ];

        Partner::create($data);

        $data = [
            'image' => '/web/assets/images/partners/2.webp'
        ];

        Partner::create($data);
        $data = [
            'image' => '/web/assets/images/partners/3.webp'
        ];

        Partner::create($data);
        $data = [
            'image' => '/web/assets/images/partners/4.webp'
        ];

        Partner::create($data);

        $data = [
            'image' => '/web/assets/images/partners/5.webp'
        ];

        Partner::create($data);

        $data = [
            'image' => '/web/assets/images/partners/6.webp'
        ];

        Partner::create($data);
    }
}
