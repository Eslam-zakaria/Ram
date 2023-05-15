<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSeoPagesToSettingsTable extends Migration
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
                'name' => 'Discounts Cards Page SEO',
                    'value' => '<meta name="title" content="" />
                                <meta name="description" content="" />
                                <meta name="keywords" content="" />
                                <link rel="canonical" href="" />',
                ],
                'ar' => [
                    'name' => 'Discounts Cards Page SEO',
                    'value' => '<meta name="title" content="" />
                                <meta name="description" content="" />
                                <meta name="keywords" content="" />
                                <link rel="canonical" href="" />',
                ],
                'key' => 'discounts_cards.seo',
            ]);

            $setting  = \Modules\Setting\Models\Setting::create([
                'en' => [
                'name' => 'Installment Page SEO',
                    'value' => '<meta name="title" content="" />
                                <meta name="description" content="" />
                                <meta name="keywords" content="" />
                                <link rel="canonical" href="" />',
                ],
                'ar' => [
                    'name' => 'Installment Page SEO',
                    'value' => '<meta name="title" content="" />
                                <meta name="description" content="" />
                                <meta name="keywords" content="" />
                                <link rel="canonical" href="" />',
                ],
                'key' => 'installment.seo',
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
