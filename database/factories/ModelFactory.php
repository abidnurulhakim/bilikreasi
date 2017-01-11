<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(App\Models\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'birthday' => $faker->date($format = 'Y-m-d', $max = 'now'),
        'phone_number' => $faker->phoneNumber,
        'secret_password' => $password ?: $password = bcrypt('secret'),
        'hash_password' => $password ?: $password = hash('secret'),
        'confirmed' => true,
        'gender' => ['male', 'female'][array_rand(['male', 'female'])],
        'role' => 'user',
        'confirmation_token' => str_random(50),
        'photo' => $faker->randomElement([
            'assets/images/user.jpg',
            'assets/images/user-1.jpg',
            'assets/images/user-2.jpg',
            'assets/images/user-3.jpg',
            'assets/images/user-4.jpg',
            'assets/images/user-5.jpg',
            ]),
    ];
});

$factory->define(App\Models\Idea::class, function (Faker\Generator $faker) {
    return [
        'title' => $faker->sentence,
        'description' => $faker->paragraph,
        'category' => ['business', 'campaign', 'community', 'project', 'event', 'other'][array_rand(['business', 'campaign', 'community', 'project', 'event', 'other'])],
        'status' => ['ready', 'ongoing', 'finish'][array_rand(['ready', 'ongoing', 'finish'])],
        'cover' => $faker->randomElement([
            'assets/images/idea.jpg',
            'assets/images/idea-1.jpg',
            'assets/images/idea-2.jpg',
            'assets/images/idea-3.jpg',
            'assets/images/idea-4.jpg',
            'assets/images/idea-5.jpg',
            ]),
    ];
});
