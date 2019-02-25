<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Loans\Loan::class, function (Faker $faker) {
  $value = array('Percentage','Cash');
  $interval = array('Day','Week', 'Month', 'Quarter', 'Year');
  $interval_key = array_rand($interval);

  $status = array('Active', 'Complete', 'Defaulting', 'Grace');
  $statuskey = array_rand( $status );

  $value_key = array_rand($value);
    return [
      'loan_type_id' => rand(1,3),
      'duration' => rand(1,12),
      'client_id' => rand(1,16),
      'principle' => $faker->randomNumber(6),
      'interest_rate' => rand(5,10),
      'interval' => $interval[$interval_key],
      'penalty' => $faker->randomNumber(2),
      'status' => $status[$statuskey],
      'penalty_value' => $value[$value_key],
    ];
});
