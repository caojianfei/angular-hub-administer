<?php

use Faker\Generator as Faker;

$users = \App\Models\User::pluck('id')->toArray();
$categories = \App\Models\Category::pluck('id')->toArray();

$factory->define(\App\Models\Article::class, function (Faker $faker) use($users, $categories) {
    return [
        'user_id' => array_random($users),
        'category_id' => 1,//array_random($categories),
        'write_type' => array_random([0, 1, 2]),
        'title' => $faker->sentence(),
        'content' => $faker->text(),
        'excerpt' => $faker->sentence(),
        'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
        'updated_at' => \Carbon\Carbon::now()->toDateTimeString()
    ];
});
