<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Modules\Setting\Models\Setting;

class AddThanksPageTextSettings extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Setting::create([
            'ar' => [
                'name' => 'Thanks Text Ar',
                'value' => 'تفاصيل الحجز موضحة بالأسفل، بالإضافة لإمكانك إضافتها للتقويم أو إرسالها لبريدك الإلكتروني'
            ],
            'en' => [
                'name' => 'Thanks Text En',
                'value' => 'The reservation details are shown below, in addition to being able to add it to the calendar or send it to your e-mail'
            ],
            'key' => 'thanks.page.text',
        ]);  }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
