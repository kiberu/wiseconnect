<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Clients\Business::class, function (Faker $faker) {
  $type = array('Agriculture', 'Industry', 'Trade', 'Transport');
  $key = array_rand($type);
    return [
      'type' => $type[$key],
      'name' => $faker->company,
    ];
});
