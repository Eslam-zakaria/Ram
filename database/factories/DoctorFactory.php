<?php

/** @var Factory $factory */

use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;
use Modules\Doctor\Models\Doctor;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(Doctor::class, function (Faker $faker) {
    return [
        'name' => $faker->sentence(2),
        'branch' => $faker->sentence(4),
        'description' =>  $faker->sentence(10),
        'image' => '/web/assets/images/drs/man.jpg',
        'created_at' => $faker->dateTimeBetween('-10 days'),
    ];
});
