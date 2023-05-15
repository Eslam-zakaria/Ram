<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNewkeyToSettingsTable extends Migration
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
                'ar' => [
                    'name' => 'Hidden Or Show Ramadan Logo',
                    'value' => 'true',
                ],
                'en' => [
                    'name' => 'Hidden Or Show Ramadan Logo',
                    'value' => 'false'
                ],
                'key' => 'ramadan.logo.option',
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
