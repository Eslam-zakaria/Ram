<?php

use Modules\Country\Models\Country;
use Modules\Setting\Models\Setting;
use Illuminate\Database\Seeder;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        Country::create([
            'ar' => [
                'name'       => 'مصر'
            ],
            'en' => [
                'name'       => 'Egypt'
            ],
            'key' => '+20',
        ]);

        Country::create([
            'ar' => [
                'name'       => 'المملكة العربية السعودية - الخبر'
            ],
            'en' => [
                'name' => 'Saudi Arabia - Al Khubar',
            ],
            'key' => '+966',
        ]);

        Country::create([
            'ar' => [
                'name'       => 'المملكة العربية السعودية - الظهران'
            ],
            'en' => [
                'name' => 'Saudi Arabia - Al Zahran',
            ],
            'key' => '+966',
        ]);

        //factory(Country::class, 20)->create();
    }
}
