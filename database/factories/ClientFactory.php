<?php

use Faker\Generator as Faker;

$factory->define(
    App\Models\Clients\Client::class, function (Faker $faker) {
        $gender = array('Male','Female');
        $key = array_rand($gender);

        return [
        'first_name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'sex' => $gender[$key],
        'date_of_birth' =>  $faker->dateTimeThisCentury->format('Y-m-d'),
        'next_of_kin' => $faker->name,
        'phone_number' => $faker->phoneNumber,
        'NIN' => $faker->phoneNumber,
        'residential_address' => $faker->address,
        'user_id' => '3',

        ];
    }
);

$factory->afterCreating(
    App\Models\Clients\Client::class, function ($client, $faker) {
      $loan = new App\Models\Loans\Loan;
      $loan->client_id = $client->id;
      $loan->loan_type_id = rand(1, 3);
      $loan->principle = round($faker->randomNumber(7), -3);;
      $loan->business_type_id = rand(1, 4);
      $loan->business_details = 'new details';
      $loan->business_location = $faker->address;
      $loan->status= 'Pending';
      $loan->collateral= 'new collateral';
      $loan->guaranters= 'new guaranters';
      $loan->other_details= 'Other Details';
      $loan->save();
    }
);
