<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTermsAndConditionsSeoToSettings extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('settings', function (Blueprint $table) {
            Schema::table('settings', function (Blueprint $table) {
                \Modules\Setting\Models\Setting::create([
                    'en' => [
                        'name' => 'Terms and conditions Page SEO',
                        'value' => '<meta name="title" content="" />
                                <meta name="description" content="" />
                                <meta name="keywords" content="" />
                                <link rel="canonical" href="" />
                                <meta property="og:title" content="" />
                                <meta property="og:type" content="website" />
                                <meta property="og:url" content="" />
                                <meta property="og:image" content="" />',
                    ],
                    'ar' => [
                        'name' => 'Terms and conditions Page SEO',
                        'value' => '<meta name="title" content="" />
                                <meta name="description" content="" />
                                <meta name="keywords" content="" />
                                <link rel="canonical" href="" />
                                <meta property="og:title" content="" />
                                <meta property="og:type" content="website" />
                                <meta property="og:url" content="" />
                                <meta property="og:image" content="" />',
                    ],
                    'key' => 'terms_and_conditions.seo',
                ]);
            });
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
