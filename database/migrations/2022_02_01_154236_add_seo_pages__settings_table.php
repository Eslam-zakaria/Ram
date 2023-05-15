<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSeoPagesSettingsTable extends Migration
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
                'name' => 'Book Page CEO',
                    'value' => '<meta name="title" content="" />
                                <meta name="description" content="" />
                                <meta name="keywords" content="" />
                                <link rel="canonical" href="" />',
                ],
                'ar' => [
                    'name' => 'Book Page CEO',
                    'value' => '<meta name="title" content="" />
                                <meta name="description" content="" />
                                <meta name="keywords" content="" />
                                <link rel="canonical" href="" />',
                ],
                'key' => 'book.ceo',
            ]);
            $setting  = \Modules\Setting\Models\Setting::create([
                'en' => [
                'name' => 'Offer Cat Page CEO',
                    'value' => '<meta name="title" content="" />
                                <meta name="description" content="" />
                                <meta name="keywords" content="" />
                                <link rel="canonical" href="" />',
                ],
                'ar' => [
                    'name' => 'Offer Cat Page CEO',
                    'value' => '<meta name="title" content="" />
                                <meta name="description" content="" />
                                <meta name="keywords" content="" />
                                <link rel="canonical" href="" />',
                ],
                'key' => 'offer-cat.ceo',
            ]);
            $setting  = \Modules\Setting\Models\Setting::create([
                'en' => [
                'name' => 'Offer List Page CEO',
                    'value' => '<meta name="title" content="" />
                                <meta name="description" content="" />
                                <meta name="keywords" content="" />
                                <link rel="canonical" href="" />',
                ],
                'ar' => [
                    'name' => 'Offer List Page CEO',
                    'value' => '<meta name="title" content="" />
                                <meta name="description" content="" />
                                <meta name="keywords" content="" />
                                <link rel="canonical" href="" />',
                ],
                'key' => 'offer-list.ceo',
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
