<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRightNowSettingsTable extends Migration
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
                    'name' => 'Leads Integration REST Token',
                    'value' => 'Basic SW50ZWdyYXRpb246UmFtQDE1OTc1Mw=',
                ],
                'ar' => [
                    'name' => 'Leads Integration REST Token',
                    'value' => 'Basic SW50ZWdyYXRpb246UmFtQDE1OTc1Mw=',
                ],
                'key' => 'leads.integration.token',
            ]);
            $setting  = \Modules\Setting\Models\Setting::create([
                'en' => [
                    'name' => 'Leads Integration REST URL',
                    'value' => 'https://ramclinics.custhelp.com/cc/Service/create_service',
                ],
                'ar' => [
                    'name' => 'Leads Integration REST URL',
                    'value' => 'https://ramclinics.custhelp.com/cc/Service/create_service',
                ],
                'key' => 'leads.integration.url',
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
