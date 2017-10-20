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
        'about_me' => $faker->text(200),
        'password' => $password ?: $password = bcrypt('secret'),
        'type' => 'visitor',
        'active' => 1,
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Post::class, function(Faker\Generator $faker) {
    $title = $faker->sentence;

    return [
        'title' => $title,
        'body' => $faker->paragraph(6),
        'active' => $faker->numberBetween(0, 1),
        'slug' => str_slug($title),
        'published_at' => $faker->dateTime,
        'user_id' => function() {
            return factory(App\User::class)->create()->id;
        }
    ];
});


$factory->define(App\Job::class, function(Faker\Generator $faker) {
    $title = $faker->sentence;

    return [
        'title' => $title,
        'description' => $faker->paragraph(6),
        'active' => 1,
        'job_title' => $faker->jobTitle,
        'type' => $faker->randomElement(['freelance', 'contract', 'cdi']),
        'url' => $faker->url,
        'company' => $faker->company,
        'slug' => str_slug($title),
        'start_date' => $faker->dateTimeThisYear,
        'end_date' => $faker->dateTimeThisYear,
        'user_id' => function() {
            return factory(App\User::class)->create([
                'type' => 'admin'
            ])->id;
        }

    ];
});


$factory->define(App\Skill::class, function(Faker\Generator $faker) {
    $title = $faker->sentence;

    return [
        'title' => $title,
        'description' => $faker->paragraph(6),
        'active' => 1,
        'type' => $faker->randomElement(['php', 'js', 'html', 'css', 'server']),
        'slug' => str_slug($title),
        'user_id' => App\User::admins()->get()->random()->id
    ];
});

$factory->define(App\Tool::class, function(Faker\Generator $faker) {
    return [
        'title' => $faker->title,
        'active' => 1,
        'description' => $faker->paragraph(),
        'user_id' => App\User::admins()->active()->get()->random()->id
    ];
});

$factory->define(App\Document::class, function(Faker\Generator $faker) {
    return [
        'filename' => $faker->userName,
        'active' => 1,
        'path' => $faker->imageUrl(),
        'documentable_id' => function() {
            return factory(App\User::class)->create()->id;
        },
        'documentable_type' => 'App\User'
    ];
}, 'avatar');


