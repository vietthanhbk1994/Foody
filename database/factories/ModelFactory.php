<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(App\Models\User::class, function (Faker\Generator $faker) {
    return [
        'username' => $faker->name,
        'email' => $faker->safeEmail,
        'avatar' => 'no-image.jpg',
        'password' => bcrypt('abc123'),
        'remember_token' => str_random(10),
    ];
});
$factory->define(App\Models\Food::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->unique()->word,
        'image' => 'no-image.jpg',
        'category_id' => $faker->randomDigitNotNull,
        'author' => $faker->randomDigitNotNull,
        'content' => $faker->paragraph,
    ];
});
$factory->define(App\Models\Category::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->unique()->word,
        'image' => 'no-image.jpg',
    ];
});
$factory->define(App\Models\Page::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->unique()->word,
        'content' => $faker->paragraph,
    ];
});