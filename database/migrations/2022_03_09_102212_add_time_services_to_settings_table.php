<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTimeServicesToSettingsTable extends Migration
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
                    'name' => 'TimeWork Derma Section',
                    'value' => '<div class="overlay-bg__block">
                    <h2 class="h6 color">Saturday to Thursday:</h2>
                    <p>8:00AM to 12:00AM</p>
                </div>
                <div class="overlay-bg__block">
                    <h2 class="h6 color">Friday:</h2>
                    <p>4:00PM to 10:00PM</p>
                </div>',
                ],
                'ar' => [
                    'name' => 'TimeWork Derma Section',
                    'value' => '<div class="overlay-bg__block">
                    <h2 class="h6 color">السبت إلى الخميس:</h2>
                    <p>08:00 صباحاً إلى 12:00 صباحاً</p>
                </div>
                <div class="overlay-bg__block">
                    <h2 class="h6 color">الجمعة:</h2>
                    <p>4:00 مساءً إلى 10:00مساءً</p>
                </div>',
                ],
                'key' => 'timework.derma.home.page',
            ]);
            $setting  = \Modules\Setting\Models\Setting::create([
                'en' => [
                    'name' => 'TimeWork Medical Section',
                    'value' => '<div class="overlay-bg__block">
                    <h2 class="h6 color">Saturday to Thursday:</h2>
                    <p>8:00AM to 12:00AM</p>
                </div>
                <div class="overlay-bg__block">
                    <h2 class="h6 color">Friday:</h2>
                    <p>4:00PM to 10:00PM</p>
                </div>',
                ],
                'ar' => [
                    'name' => 'TimeWork Medical Section',
                    'value' => '<div class="overlay-bg__block">
                    <h2 class="h6 color">السبت إلى الخميس:</h2>
                    <p>08:00 صباحاً إلى 12:00 صباحاً</p>
                </div>
                <div class="overlay-bg__block">
                    <h2 class="h6 color">الجمعة:</h2>
                    <p>4:00 مساءً إلى 10:00مساءً</p>
                </div>',
                ],
                'key' => 'timework.medical.home.page',
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
