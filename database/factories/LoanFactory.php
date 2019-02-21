<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Loans\Loan::class, function (Faker $faker) {
  $interval = array('Daily','Weekly', 'Monthly', 'Quarterly', 'Yearly');
  $value = array('Percentage','Cash');

  $interval_key = array_rand($interval);
  $value_key = array_rand($value);
    return [
      'type_id' => rand(1,3),
      'duration' => rand(1,50),
      'interval' => $interval[$interval_key],
      'principle' => $faker->randomNumber(6),
      'interest' => $faker->randomNumber(2),
      'penalty' => $faker->randomNumber(2),
      'penalty_value' => $value[$value_key],
    ];
});
