<?php

use App\StatusShippingUnit;
use Faker\Generator as Faker;

$factory->define(StatusShippingUnit::class, function (Faker $faker) {
    return [
        'name' => 'Còn hợp tác',
    ];
});
