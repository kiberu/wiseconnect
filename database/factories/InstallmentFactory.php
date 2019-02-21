<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Loans\Installment::class, function (Faker $faker) {
    return [
      'loan_id' => rand(1,60),
      'amount' => $faker->randomNumber(4),
    ];
});
