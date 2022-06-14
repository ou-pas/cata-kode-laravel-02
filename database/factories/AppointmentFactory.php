<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Appointment;
use Faker\Generator as Faker;

$factory->define(Appointment::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'phone' => $faker->numerify('+33600000000'),
        'email' => $faker->email,
        'schedule_at' => $faker->dateTime->format('d/m/Y H:i'),
        'message' => $faker->text
    ];
});
