<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Question;
use App\User;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Question::class, function (Faker $faker) {
    $title = $faker->sentence;
    return [
        'title' => $title,
        'slug' => Str::slug($title),
        'body' => $faker->paragraph,
        'views' => rand(0, 10),
        'answers_count' => rand(0, 10),
        'votes' => rand(-5, 10),
        'user_id' => $faker->randomElement(User::all()->pluck('id')),
    ];
});
