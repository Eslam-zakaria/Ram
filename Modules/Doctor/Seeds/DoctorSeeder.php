<?php

namespace Modules\Doctor\Seeds;


use Illuminate\Database\Seeder;
use Modules\Doctor\Models\Doctor;

class DoctorSeeder extends Seeder
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
                'name'       => 'د. عبدالرؤوف الغزالي',
                'slug'       => 'عبدالرؤوف-الغزالي',
                'description'       => '<li>طبيب أسنان بعيادات رام.</li>
                <li>طبيب أسنان بعيادات إيلايت كلينك.</li>
                <li>طبيب أسنان بمستشفي الصفوة التخصصي من ماجستي.</li>
                <li>طبيب أسنان بعيادات الكحال الطبية.</li>
                <li>بكالريوس طب الأسنان بجامعة القاهرة.</li>',
                'bio'       => 'لوريم ايبسوم دولار سيت أميت ,كونسيكتيتور أدايبا يسكينج أليايت,سيت دو أيوسمود تيمبور أنكايديديونتيوت لابوري ات دولار ماجنا أليكيوالوريم ايبسوم دولار سيت أميت ,كونسيكتيتور أدايبا يسكينج أليايت,سيت دو أيوسمود تيمبور أنكايديديونتيوت لابوري ات دولار ماجنا أليكيوا',
            ],
            'en' => [
                'name'       => 'Dr. Abdul Raouf Al-Ghazali',
                'slug'       => 'Abdul-Raouf-Al-Ghazali',
                'description'       => '<li>Dentist at Ram Clinics.</li>
                <li>Dentist at Elite Clinic.</li>
                <li>Dentist at Al Safwa Specialized Hospital from Majesty.</li>
                <li>Dentist at Al Kahal Medical Clinics.</li>
                <li>Bachelor of Dentistry at Cairo University.</li>',
                'bio'       => 'Dr.. Abdul-Raouf Al-Ghazali Lorem Epsom Dollar Set Amit, Consector Adaiba Asking Alite, Set de Ayusmod tempur ankidionteut laborit at Magna Dollar Aliquiwallurem Epsom Dollar Set Amit, Consector Adaiba Isking Alite, Sit de Ayosemod Dollar Tempur Labourye Ankidionte
                ',
            ],
            'start_time' =>'09:00:00',
            'end_time' =>'21:00:00',
            'years_of_experience' => '+9',
            'image' => '/web/assets/images/doctors/5.jpg',
            'country_id' => 3,
            'specialty_id' => 1,
        ];

        $doctor = Doctor::create($data);

        $doctor->branches()->attach([3,4]);
        $doctor->specificities()->attach([1,2,3]);

        $data = [
            'ar' => [
                'name'       => 'د. عبير عبد المنعم',
                'slug'       => 'عبير-عبد-المنعم',
                'description'       => '<li>طبيب أسنان بعيادات رام.</li>
                <li>طبيب أسنان بعيادات إيلايت كلينك.</li>
                <li>طبيب أسنان بمستشفي الصفوة التخصصي من ماجستي.</li>
                <li>طبيب أسنان بعيادات الكحال الطبية.</li>
                <li>بكالريوس طب الأسنان بجامعة القاهرة.</li>',
                'bio'       => 'لوريم ايبسوم دولار سيت أميت ,كونسيكتيتور أدايبا يسكينج أليايت,سيت دو أيوسمود تيمبور أنكايديديونتيوت لابوري ات دولار ماجنا أليكيوالوريم ايبسوم دولار سيت أميت ,كونسيكتيتور أدايبا يسكينج أليايت,سيت دو أيوسمود تيمبور أنكايديديونتيوت لابوري ات دولار ماجنا أليكيوا',
            ],
            'en' => [
                'name'       => 'Dr.Abeer Abdel Moneim',
                'slug'       => 'Abeer-Abdel-Moneim',
                'description'       => '<li>Dentist at Ram Clinics.</li>
                <li>Dentist at Elite Clinic.</li>
                <li>Dentist at Al Safwa Specialized Hospital from Majesty.</li>
                <li>Dentist at Al Kahal Medical Clinics.</li>
                <li>Bachelor of Dentistry at Cairo University.</li>',
                'bio'       => 'Dr.. Abdul-Raouf Al-Ghazali Lorem Epsom Dollar Set Amit, Consector Adaiba Asking Alite, Set de Ayusmod tempur ankidionteut laborit at Magna Dollar Aliquiwallurem Epsom Dollar Set Amit, Consector Adaiba Isking Alite, Sit de Ayosemod Dollar Tempur Labourye Ankidionte
                ',
            ],
            'start_time' =>'16:15:00',
            'end_time' =>'20:30:00',
            'years_of_experience' => '+9',
            'image' => '/web/assets/images/doctors/2.jpg',
            'country_id' => 2,
            'specialty_id' => 1,
        ];

        $doctor2 = Doctor::create($data);

        $doctor2->branches()->attach([1,2]);
        $doctor2->specificities()->attach([3,4]);

        $data = [
            'ar' => [
                'name'       => 'د. عبير العنزي',
                'slug'       => 'عبير-العنزي',
                'description'       => '<li>طبيب أسنان بعيادات رام.</li>
                <li>طبيب أسنان بعيادات إيلايت كلينك.</li>
                <li>طبيب أسنان بمستشفي الصفوة التخصصي من ماجستي.</li>
                <li>طبيب أسنان بعيادات الكحال الطبية.</li>
                <li>بكالريوس طب الأسنان بجامعة القاهرة.</li>',
                'bio'       => 'لوريم ايبسوم دولار سيت أميت ,كونسيكتيتور أدايبا يسكينج أليايت,سيت دو أيوسمود تيمبور أنكايديديونتيوت لابوري ات دولار ماجنا أليكيوالوريم ايبسوم دولار سيت أميت ,كونسيكتيتور أدايبا يسكينج أليايت,سيت دو أيوسمود تيمبور أنكايديديونتيوت لابوري ات دولار ماجنا أليكيوا',
            ],
            'en' => [
                'name'       => 'Dr.Abeer Al-Anzi',
                'slug'       => 'Abeer-Al-Anzi',
                'description'       => '<li>Dentist at Ram Clinics.</li>
                <li>Dentist at Elite Clinic.</li>
                <li>Dentist at Al Safwa Specialized Hospital from Majesty.</li>
                <li>Dentist at Al Kahal Medical Clinics.</li>
                <li>Bachelor of Dentistry at Cairo University.</li>',
                'bio'       => 'Dr.. Abdul-Raouf Al-Ghazali Lorem Epsom Dollar Set Amit, Consector Adaiba Asking Alite, Set de Ayusmod tempur ankidionteut laborit at Magna Dollar Aliquiwallurem Epsom Dollar Set Amit, Consector Adaiba Isking Alite, Sit de Ayosemod Dollar Tempur Labourye Ankidionte
                ',
            ],
            'start_time' =>'08:30:00',
            'end_time' =>'13:00:00',
            'years_of_experience' => '+5',
            'image' => '/web/assets/images/doctors/4.jpg',
            'country_id' => 2,
            'specialty_id' => 1,
        ];

        $doctor3 = Doctor::create($data);

        $doctor3->branches()->attach([2]);
        $doctor3->specificities()->attach([4,5]);

        $data = [
            'ar' => [
                'name'       => ' د. عبداللطيف محمد',
                'slug'       => 'عبداللطيف-محمد',
                'description'       => '<li>طبيب أسنان بعيادات رام.</li>
                <li>طبيب أسنان بعيادات إيلايت كلينك.</li>
                <li>طبيب أسنان بمستشفي الصفوة التخصصي من ماجستي.</li>
                <li>طبيب أسنان بعيادات الكحال الطبية.</li>
                <li>بكالريوس طب الأسنان بجامعة القاهرة.</li>',
                'bio'       => 'لوريم ايبسوم دولار سيت أميت ,كونسيكتيتور أدايبا يسكينج أليايت,سيت دو أيوسمود تيمبور أنكايديديونتيوت لابوري ات دولار ماجنا أليكيوالوريم ايبسوم دولار سيت أميت ,كونسيكتيتور أدايبا يسكينج أليايت,سيت دو أيوسمود تيمبور أنكايديديونتيوت لابوري ات دولار ماجنا أليكيوا',
            ],
            'en' => [
                'name'       => 'Dr.Abdul Latif Muhammed',
                'slug'       => 'Abdul-Latif-Muhammed',
                'description'       => '<li>Dentist at Ram Clinics.</li>
                <li>Dentist at Elite Clinic.</li>
                <li>Dentist at Al Safwa Specialized Hospital from Majesty.</li>
                <li>Dentist at Al Kahal Medical Clinics.</li>
                <li>Bachelor of Dentistry at Cairo University.</li>',
                'bio'       => 'Dr.. Abdul-Raouf Al-Ghazali Lorem Epsom Dollar Set Amit, Consector Adaiba Asking Alite, Set de Ayusmod tempur ankidionteut laborit at Magna Dollar Aliquiwallurem Epsom Dollar Set Amit, Consector Adaiba Isking Alite, Sit de Ayosemod Dollar Tempur Labourye Ankidionte
                ',
            ],
            'start_time' =>'19:00:00',
            'end_time' =>'23:00:00',
            'years_of_experience' => '+6',
            'image' => '/web/assets/images/doctors/1.jpg',
            'country_id' => 3,
            'specialty_id' => 1,
        ];

        $doctor4 = Doctor::create($data);

        $doctor4->branches()->attach([3,4]);
        $doctor4->specificities()->attach([3,4,5]);
    }
}
