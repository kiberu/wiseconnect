<?php

use Faker\Generator as Faker;
use Carbon\Carbon;

$factory->define(App\Models\Loans\Installment::class, function (Faker $faker) {
    return [
      'amount_paid' => rand(1000,2000),
      'next_due_date' => Carbon::today()->addDays(5)
    ];
});
