<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'firstname' => $faker->firstName,
        'lastname' => $faker->lastName,
        'email' => $faker->unique()->safeEmail,
        'address' => $faker->streetAddress,
        'city' => $faker->city,
        'postcode' => $faker->postcode,
        'password' => $password ?: $password = bcrypt('secret'),
        'type' => 'visitor',
        'active' => $faker->numberBetween(0,1),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\User::class, function() use ($factory) {
    $user = $factory->raw(App\User::class);

    return array_merge($user, [
        'type' => 'headhunter'
    ]);
}, 'headhunter');

$factory->define(App\User::class, function() use ($factory) {
    $user = $factory->raw(App\User::class);

    return array_merge($user, [
        'type' => 'admin'
    ]);
}, 'admins');
