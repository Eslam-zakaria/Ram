<?php

namespace Modules\Video\Seeds;


use Illuminate\Database\Seeder;
use Modules\Video\Models\Video;

class VideoSeeder extends Seeder
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
                'name'       => 'أهمية جلسات شد الوجه والرقبة بتقنية الهايفو',
            ],
            'en' => [
                'name'       => 'The importance of face and neck lift sessions with HIFU technique',
            ],
            'doctor_id' => 1,
            'image' => '/web/assets/images/video.jpg',
            'video' => '/web/assets/videos/reviews.mp4',
        ];

        Video::create($data);
    }
}
