<?php

use Faker\Generator as Faker;

$factory->define(JeroenG\Facilitator\Tests\Fixtures\Models\Task::class, function (Faker $faker) {
    return [
        'title' => $faker->title,
        'content' => $faker->paragraph,
        'checked' => false,
    ];
});

$factory->define(JeroenG\Facilitator\Tests\Fixtures\Models\TaskWithRequest::class, function (Faker $faker) {
    return [
        'title' => $faker->title,
        'content' => $faker->paragraph,
        'checked' => false,
    ];
});
