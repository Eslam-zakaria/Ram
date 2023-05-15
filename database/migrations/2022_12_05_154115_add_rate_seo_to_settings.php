<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRateSeoToSettings extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('settings', function (Blueprint $table) {
            \Modules\Setting\Models\Setting::create([
                'en' => [
                    'name' => 'Rate Page SEO',
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
                    'name' => 'Rate Page SEO',
                    'value' => '<meta name="title" content="" />
                                <meta name="description" content="" />
                                <meta name="keywords" content="" />
                                <link rel="canonical" href="" />
                                <meta property="og:title" content="" />
                                <meta property="og:type" content="website" />
                                <meta property="og:url" content="" />
                                <meta property="og:image" content="" />',
                ],
                'key' => 'rate.seo',
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
