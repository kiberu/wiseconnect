<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Clients\Client::class, function (Faker $faker) {
  $gender = array('Male','Female');
  $key = array_rand($gender);

    return [
      'first_name' => $faker->firstName,
      'last_name' => $faker->lastName,
      'business_id' => function () {
            return factory(App\Models\Clients\Business::class)->create()->id;
        },
      'sex' => $gender[$key],
      'date_of_birth' =>  $faker->dateTimeThisCentury->format('Y-m-d'),
      'next_of_kin' => $faker->name,
      'phone_number' => $faker->phoneNumber,
      'residential_address' => $faker->address,
    ];
});
