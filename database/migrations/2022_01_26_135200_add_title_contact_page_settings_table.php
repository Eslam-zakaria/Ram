<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTitleContactPageSettingsTable extends Migration
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
                'name' => 'Contact Page Titles',
                    'value' => '<h2 class="title" data-aos="fade-up">
                                  Always Here to Help!
                                </h2>
                                <p data-aos="fade-up" data-aos-delay="100">
                                Your inquiries, suggestions, and complains all are most welcomed.
                                </p>',
                ],
                'ar' => [
                    'name' => 'Contact Page Titles',
                    'value' => '<h2 class="title" data-aos="fade-up">
                                  نسعد بتواصلك معنا  
                                </h2>
                                <p data-aos="fade-up" data-aos-delay="100">
                                نحن هنا لاستقبال جميع استفساراتك، اقتراحاتك، وجميع الشكاوى بصدر رحب.
                                </p>',
                ],
                'key' => 'contact-us.titles',
            ]);
            $setting  = \Modules\Setting\Models\Setting::create([
                'en' => [
                'name' => 'Thank You Installment Page',
                    'value' => '<h2 class="title" data-aos="fade-up">
                                Thank you, <br>
                                <span class="color">We have received your Review</span>
                            </h2>
                            <p class="lead" data-aos="fade-up" data-aos-delay="100">
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Esse quos saepe obcaecati inventore ut quidem voluptatibus est. Ad fugit
                                laborum eaque delectus qui! Tempore ullam iusto, recusandae id voluptatum ipsam.
                            </p>',
                ],
                'ar' => [
                    'name' => 'Thank You Installment Page',
                    'value' => '<h2 class="title" data-aos="fade-up">
                                    شكراً لك،، <br>
                                    <span class="color">لقد تلقينا تقييمك</span>
                                </h2>
                                <p class="lead" data-aos="fade-up" data-aos-delay="100">
                                    إذا كنت تحتاج إلى نص ينوب عن محتوى لم يتم إنشائه بعد، يمكنك استخدام هذه الأداة. بهذه الطريقة، يصبح بإمكان مصممي
                                    الرسومات ومطوري المواقع، الخ التركيز على العناصر الرئيسية الأخرى
                                </p>',
                ],
                'key' => 'thanks.title.page.installment',
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
