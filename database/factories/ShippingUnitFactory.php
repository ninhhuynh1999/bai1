<?php

use App\ShippingUnit;
use Faker\Generator as Faker;

$factory->define(ShippingUnit::class, function (Faker $faker) {
    return [
        'name' => $faker->name(),
        'shortName' => $faker->regexify('[A-Z]{5}'),
        'name' => $faker->name,

        'phoneNumber' =>  $faker->numerify('##########'),
        'taxId' => $faker->numerify('##########'), // secret
        'dateStopContact' => $faker->dateTimeBetween('-10 months', 'now'),
        'bankName' => $faker->name(),
        'bankNumber' => $faker->bankAccountNumber,
        'bankAddress' => $faker->address,
        'address' => $faker->address,
        'status_id' => $faker->numberBetween(1, 2),
        'contact' => $faker->text(200),
        'note' => $faker->text(200),
        'created_by' => $faker->numberBetween(1, 4),
        'updated_by' => $faker->numberBetween(1, 4),
    ];
});
