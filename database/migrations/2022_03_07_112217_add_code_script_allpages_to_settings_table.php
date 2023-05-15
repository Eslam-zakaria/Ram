<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCodeScriptAllpagesToSettingsTable extends Migration
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
                    'name' => 'Add Any Code In Head All Page',
                    'value' => '',
                ],
                'ar' => [
                    'name' => 'Add Any Code In Head All Page',
                    'value' => '',
                ],
                'key' => 'code.head.allpage',
            ]);
            $setting  = \Modules\Setting\Models\Setting::create([
                'en' => [
                    'name' => 'Add Any Code In Foot All Page',
                    'value' => '',
                ],
                'ar' => [
                    'name' => 'Add Any Code In Foot All Page',
                    'value' => '',
                ],
                'key' => 'code.foot.allpage',
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
