<?php

namespace Modules\Job\Seeds;


use Illuminate\Database\Seeder;
use Modules\Job\Models\Job;

class JobSeeder extends Seeder
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
                'name'       => 'فني تركيب نظارات',
                'content'       => 'فني تركيب نظارات',
                'description' => "<p>
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Inventore eum eos voluptatem modi rerum esse ratione rem soluta
                        accusamus
                        qui magni quae, mollitia, amet, quaerat itaque! Delectus exercitationem saepe quasi repellendus explicabo incidunt, laudantium
                        maxime modi consequatur doloremque. Cupiditate nulla eveniet quia quam temporibus ut necessitatibus aspernatur nisi est error.
                    </p>
                    <p>
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Deleniti voluptatem ea cumque ipsa obcaecati debitis quos optio
                        officiis
                        magni ut.
                    </p>
                    <p>
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Officia, ratione. Facere optio nesciunt laboriosam unde libero
                        voluptatibus sapiente earum ratione quidem velit! Temporibus, doloribus sequi?
                    </p>",
                "requirements" => "<p>
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Inventore eum eos voluptatem modi rerum esse ratione rem soluta
                        accusamus
                        qui magni quae, mollitia, amet, quaerat itaque! Delectus exercitationem saepe quasi repellendus explicabo incidunt, laudantium
                        maxime modi consequatur doloremque. Cupiditate nulla eveniet quia quam temporibus ut necessitatibus aspernatur nisi est error.
                    </p>
                    <p>
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Deleniti voluptatem ea cumque ipsa obcaecati debitis quos optio
                        officiis
                        magni ut.
                    </p>
                    <p>
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Officia, ratione. Facere optio nesciunt laboriosam unde libero
                        voluptatibus sapiente earum ratione quidem velit! Temporibus, doloribus sequi?
                    </p>"

            ],
            'en' => [
                'name'       => 'Eyewear fitting technician',
                'content'       => 'Eyewear fitting technician',
                'description' => "<p>
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Inventore eum eos voluptatem modi rerum esse ratione rem soluta
                        accusamus
                        qui magni quae, mollitia, amet, quaerat itaque! Delectus exercitationem saepe quasi repellendus explicabo incidunt, laudantium
                        maxime modi consequatur doloremque. Cupiditate nulla eveniet quia quam temporibus ut necessitatibus aspernatur nisi est error.
                    </p>
                    <p>
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Deleniti voluptatem ea cumque ipsa obcaecati debitis quos optio
                        officiis
                        magni ut.
                    </p>
                    <p>
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Officia, ratione. Facere optio nesciunt laboriosam unde libero
                        voluptatibus sapiente earum ratione quidem velit! Temporibus, doloribus sequi?
                    </p>",
                "requirements" => "<p>
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Inventore eum eos voluptatem modi rerum esse ratione rem soluta
                        accusamus
                        qui magni quae, mollitia, amet, quaerat itaque! Delectus exercitationem saepe quasi repellendus explicabo incidunt, laudantium
                        maxime modi consequatur doloremque. Cupiditate nulla eveniet quia quam temporibus ut necessitatibus aspernatur nisi est error.
                    </p>
                    <p>
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Deleniti voluptatem ea cumque ipsa obcaecati debitis quos optio
                        officiis
                        magni ut.
                    </p>
                    <p>
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Officia, ratione. Facere optio nesciunt laboriosam unde libero
                        voluptatibus sapiente earum ratione quidem velit! Temporibus, doloribus sequi?
                    </p>"
            ],
            "department_id" => 1,
            "branche_id" => 1
        ];

        Job::create($data);
    }
}
