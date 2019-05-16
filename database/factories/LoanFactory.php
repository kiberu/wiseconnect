<?php

use Faker\Generator as Faker;

$factory->define(
    App\Models\Loans\Loan::class, function (Faker $faker) {
        $value = array('Percentage','Cash');
        $interval = array('Day','Week', 'Month', 'Quarter', 'Year');
        $interval_key = array_rand($interval);

        $payment_days = array( 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday');
        $payment_key = array_rand($payment_days);

        $principle = round($faker->randomNumber(7), -3);
        $duration = rand(1, 12);
        $interest_rate = rand(5, 10);
        $grace = 1;

        $value_key = array_rand($value);
        $payment_day = $payment_days[$payment_key];
        return [
        'loan_type_id' => rand(1, 3),
        'duration' => $duration ,
        'client_id' => rand(1, 16),
        'principle' => $principle,
        'interest_rate' => $interest_rate,
        'penalty' => $faker->randomNumber(2),
        'grace_period' => $grace,
        'status' => 'Active',
        'business_type_id' => rand(1, 4),
        'payment_day' => $payment_day,
        'business_location' => $faker->address,
        'partial_amount' => round(( $principle / $duration ) + ( $principle * $interest_rate / 100), -3),
        'initial_start' => Carbon::parse('next ' . $payment_day)->addWeek($grace),
        'application_fee' => round($faker->randomNumber(4), -3),
        'insurance_fee' => round($faker->randomNumber(4), -3)
        ];
    }
);

$factory->afterCreating(
    App\Models\Loans\Loan::class, function ($loan, $faker) {
        $installment = new App\Models\Loans\Installment;
        $installment->loan_id = $loan->id;
        $installment->expected_amount = $loan->partial_amount;
        $installment->due_date = $loan->initial_start;
        $installment->status = 'Pending';
        $installment->balance = $loan->partial_amount;
        $installment->save();
    }
);
