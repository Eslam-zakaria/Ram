<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCeoFildesToSettingsTable extends Migration
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
                'name' => 'blog index description',
                    'value' => '<h2 class="title">
                                Latest <span class="color">Articles</span>
                            </h2>
                            <p>
                                You will live a unique experience during your treatment because we are pioneers in healthcare with a comfortable environment and
                                integrated care that we provide to you.
                            </p>',
                ],
                'ar' => [
                    'name' => 'blog index description',
                    'value' => '<h2 class="title">
                                مقالات <span class="color">رام</span>
                            </h2>
                            <p>
                                هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي القارئ عن التركيز على الشكل الخارجي للنص
                            </p>',
                ],
                'key' => 'blog.index.description',
            ]);

            $setting  = \Modules\Setting\Models\Setting::create([
                'en' => [
                'name' => 'Home Page CEO',
                    'value' => '<meta name="description" content="" />
                                <meta name="keywords" content="" />
                                <link rel="canonical" href="" />',
                ],
                'ar' => [
                    'name' => 'Home Page CEO',
                    'value' => '<meta name="description" content="" />
                                <meta name="keywords" content="" />
                                <link rel="canonical" href="" />',
                ],
                'key' => 'home.ceo',
            ]);

            $setting  = \Modules\Setting\Models\Setting::create([
                'en' => [
                'name' => 'About Page CEO',
                    'value' => '<meta name="description" content="" />
                                <meta name="keywords" content="" />
                                <link rel="canonical" href="" />',
                ],
                'ar' => [
                    'name' => 'About Page CEO',
                    'value' => '<meta name="description" content="" />
                                <meta name="keywords" content="" />
                                <link rel="canonical" href="" />',
                ],
                'key' => 'about.ceo',
            ]);
            $setting  = \Modules\Setting\Models\Setting::create([
                'en' => [
                'name' => 'Services Page CEO',
                    'value' => '<meta name="description" content="" />
                                <meta name="keywords" content="" />
                                <link rel="canonical" href="" />',
                ],
                'ar' => [
                    'name' => 'Services Page CEO',
                    'value' => '<meta name="description" content="" />
                                <meta name="keywords" content="" />
                                <link rel="canonical" href="" />',
                ],
                'key' => 'services.ceo',
            ]);
            $setting  = \Modules\Setting\Models\Setting::create([
                'en' => [
                'name' => 'Doctors Page CEO',
                    'value' => '<meta name="description" content="" />
                                <meta name="keywords" content="" />
                                <link rel="canonical" href="" />',
                ],
                'ar' => [
                    'name' => 'Doctors Page CEO',
                    'value' => '<meta name="description" content="" />
                                <meta name="keywords" content="" />
                                <link rel="canonical" href="" />',
                ],
                'key' => 'doctors.ceo',
            ]);
            $setting  = \Modules\Setting\Models\Setting::create([
                'en' => [
                'name' => 'Blogs Page CEO',
                    'value' => '<meta name="description" content="" />
                                <meta name="keywords" content="" />
                                <link rel="canonical" href="" />',
                ],
                'ar' => [
                    'name' => 'Blogs Page CEO',
                    'value' => '<meta name="description" content="" />
                                <meta name="keywords" content="" />
                                <link rel="canonical" href="" />',
                ],
                'key' => 'blogs.ceo',
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
