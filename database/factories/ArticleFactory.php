<?php

use Faker\Generator as Faker;

//$users = \App\Models\User::pluck('id')->toArray();
//$categories = \App\Models\Category::pluck('id')->toArray();
$users = [1,2,3,4,5];
$categories = [1,2,3];

$factory->define(\App\Models\Article::class, function (Faker $faker) use($users, $categories) {
    return [
        'user_id' => array_random($users),
        'category_id' => array_random($categories),
        'write_type' => array_random([0, 1, 2]),
        'title' => $faker->sentence(),
        'content' => $faker->text(),
        'excerpt' => $faker->sentence(),
        'status' => 1,
        'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
        'updated_at' => \Carbon\Carbon::now()->toDateTimeString()
    ];
});
