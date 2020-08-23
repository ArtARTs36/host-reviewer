<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\DbSystem;
use Faker\Generator as Faker;

$factory->define(DbSystem::class, function (Faker $faker) {
    return [
        DbSystem::FIELD_NAME => $faker->name,
        DbSystem::FIELD_KEY => $faker->slug,
    ];
});
