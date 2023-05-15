<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUrlTocounterToSettingsTable extends Migration
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
                'name' => 'Add Url To Counter Slider',
                    'value' => ' ',
                ],
                'ar' => [
                    'name' => 'Add Url To Counter Slider',
                    'value' => ' ',
                ],
                'key' => 'url.counter.slider',
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
