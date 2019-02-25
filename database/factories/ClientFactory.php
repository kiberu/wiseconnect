<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Clients\Client::class, function (Faker $faker) {
  $gender = array('Male','Female');
  $key = array_rand($gender);

    return [
      'first_name' => $faker->firstName,
      'last_name' => $faker->lastName,
      'business_type_id' => rand(1,4),
      'business_name' => $faker->company,
      'sex' => $gender[$key],
      'date_of_birth' =>  $faker->dateTimeThisCentury->format('Y-m-d'),
      'next_of_kin' => $faker->name,
      'phone_number' => $faker->phoneNumber,
      'residential_address' => $faker->address,
    ];
});
