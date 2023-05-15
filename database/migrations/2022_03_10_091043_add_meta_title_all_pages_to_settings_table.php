<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMetaTitleAllPagesToSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('settings', function (Blueprint $table) {
            $setting  = \Modules\Setting\Models\Setting::create([
                'en' => [
                'name' => 'Meta Title Home Page',
                    'value' => 'Welcome to Ram Clinics',
                ],
                'ar' => [
                    'name' => 'Meta Title Home Page',
                    'value' => 'مرحباً بكم في عيادات رام',
                ],
                'key' => 'metatitle.home',
            ]);
            $setting  = \Modules\Setting\Models\Setting::create([
                'en' => [
                'name' => 'Meta Title About Page',
                    'value' => 'About Ram Clinics',
                ],
                'ar' => [
                    'name' => 'Meta Title About Page',
                    'value' => 'عن عيادات رام',
                ],
                'key' => 'metatitle.about',
            ]);
            $setting  = \Modules\Setting\Models\Setting::create([
                'en' => [
                'name' => 'Meta Title Contact Page',
                    'value' => 'Contact Us',
                ],
                'ar' => [
                    'name' => 'Meta Title Contact Page',
                    'value' => 'الإتصال بنا',
                ],
                'key' => 'metatitle.contact',
            ]);
            $setting  = \Modules\Setting\Models\Setting::create([
                'en' => [
                'name' => 'Meta Title Services Page',
                    'value' => 'Ram Services',
                ],
                'ar' => [
                    'name' => 'Meta Title Services Page',
                    'value' => 'خدمات عيادات رام',
                ],
                'key' => 'metatitle.services',
            ]);
            $setting  = \Modules\Setting\Models\Setting::create([
                'en' => [
                'name' => 'Meta Title Doctors Page',
                    'value' => 'Ram Doctors',
                ],
                'ar' => [
                    'name' => 'Meta Title Doctors Page',
                    'value' => 'أطباء رام',
                ],
                'key' => 'metatitle.doctors',
            ]);
            $setting  = \Modules\Setting\Models\Setting::create([
                'en' => [
                'name' => 'Meta Title Blogs Page',
                    'value' => 'Ram Blog',
                ],
                'ar' => [
                    'name' => 'Meta Title Blogs Page',
                    'value' => 'مقالات رام',
                ],
                'key' => 'metatitle.blogs',
            ]);
            $setting  = \Modules\Setting\Models\Setting::create([
                'en' => [
                'name' => 'Meta Title Book Page',
                    'value' => 'Book Your Appointment Now',
                ],
                'ar' => [
                    'name' => 'Meta Title Book Page',
                    'value' => 'إحجز موعدك الآن',
                ],
                'key' => 'metatitle.book',
            ]);
            $setting  = \Modules\Setting\Models\Setting::create([
                'en' => [
                'name' => 'Meta Title Offer List Page',
                    'value' => '',
                ],
                'ar' => [
                    'name' => 'Meta Title Offer List Page',
                    'value' => '',
                ],
                'key' => 'metatitle.offer-list',
            ]);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('settings', function (Blueprint $table) {
            //
        });
    }
}
