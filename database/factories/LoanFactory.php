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
      'penalty' => $faker->randomNumber(2),
      'grace_period' => rand(1,5),
      'status' => $status[$statuskey],
      'business_type_id' => rand(1,4),
      'business_name' => $faker->company,
    ];
});

$factory->afterCreating(App\Models\Loans\Loan::class, function ($loan, $faker) {
    $loan->installments()->save(factory(App\Models\Loans\Installment::class)->make());
});
