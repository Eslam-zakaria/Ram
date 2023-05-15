<?php

/** @var Factory $factory */

use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;
use Modules\Offer\Models\Offer;

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

$factory->define(Offer::class, function (Faker $faker) {
    return [
        'name' => $faker->sentence(2),
        'description' =>  $faker->sentence(10),
        'image' => '/web/assets/images/offer.jpg',
        'created_at' => $faker->dateTimeBetween('-10 days'),
    ];
});
