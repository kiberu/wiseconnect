<?php

use Faker\Generator as Faker;

$factory->define(
    App\Models\Clients\Group::class, function (Faker $faker) {
        return [
        'name' => $faker->company,
        'landmark' => $faker->streetName,
        ];
    }
);
