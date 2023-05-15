<?php

namespace Modules\Testimonial\Seeds;


use App\Constants\Statuses;
use Illuminate\Database\Seeder;
use Modules\Testimonial\Models\Testimonial;

class TestimonialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            'ar' => [
                'name'       => 'أمل النعماني',
                'description' => '
                                    الاعتبارات ، يوم المكتب هو بهذه الطريقة. جئت لرصد الجدران. يجب أن وأخذ القصر
                                    أعيد كتابتها ، حتى تعرف على كيفية توفير أعظم كتاب ما دامت البوق تعيش ذلك. بالنسبة لمن لديه ويذهب هو أ
                                    عنوان درع على الإنترنت السؤال فقط كل ما لديك.
                               '
            ],
            'en' => [
                'name'       => 'Amal Al Nomaani',
                'description' => 'The considerations, office day he those way. Came I to to monitors walls. My should the and taken palace
                                    rewritten, even get how thought greatest book provide long as trumpet the live that. For the have and go is a
                                    headline armour over question internet just every him your.'
            ],
            'status' => Statuses::ACTIVE,
        ];

        Testimonial::create($data);

        $data = [
            'ar' => [
                'name'       => 'أمل النعماني',
                'description' => '
                                    الاعتبارات ، يوم المكتب هو بهذه الطريقة. جئت لرصد الجدران. يجب أن وأخذ القصر
                                    أعيد كتابتها ، حتى تعرف على كيفية توفير أعظم كتاب ما دامت البوق تعيش ذلك. بالنسبة لمن لديه ويذهب هو أ
                                    عنوان درع على الإنترنت السؤال فقط كل ما لديك.
                               '
            ],
            'en' => [
                'name'       => 'Amal Al Nomaani',
                'description' => 'The considerations, office day he those way. Came I to to monitors walls. My should the and taken palace
                                    rewritten, even get how thought greatest book provide long as trumpet the live that. For the have and go is a
                                    headline armour over question internet just every him your.'
            ],
            'status' => Statuses::ACTIVE,
        ];

        Testimonial::create($data);
    }
}
