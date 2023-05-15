<?php

/** @var Factory $factory */

use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;
use Modules\Page\Models\Page;

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

$factory->define(Page::class, function (Faker $faker) {
    return [
        'name' => $faker->sentence(2),
        'slug' => $faker->word().'-'.$faker->word,
        'description' =>  $faker->sentence(10),
        'image' => '/web/assets/images/'.$faker->numberBetween(1, 4).'.png',
        'created_at' => now(),
    ];
});
