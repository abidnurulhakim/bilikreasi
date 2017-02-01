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
        'role' => $faker->randomElement(['user', 'admin']),
        'confirmation_token' => str_random(50),
        'photo' => $faker->randomElement([
            'assets/images/user.jpg',
            'assets/images/user-1.jpg',
            'assets/images/user-2.jpg',
            'assets/images/user-3.jpg',
            'assets/images/user-4.jpg',
            'assets/images/user-5.jpg',
            ]),
        'profession' => $faker->word,
        'live_at' => $faker->country,
        'interests' => $faker->words($faker->numberBetween(1, 6), false),
        'skills' => $faker->words($faker->numberBetween(1, 6), false),
        'last_login_ip_address' => $faker->ipv4,
        'last_login_at' => $faker->dateTime('now', date_default_timezone_get()),
        'about' => $faker->text($faker->numberBetween(100, 300)),
    ];
});

$factory->define(App\Models\Idea::class, function (Faker\Generator $faker) {
    $array = [
        'title' => $faker->sentence,
        'description' => $faker->paragraph,
        'category' => $faker->randomElement(['business', 'campaign', 'community', 'project', 'event', 'other']),
        'status' => $faker->randomElement(['ready', 'ongoing', 'finish']),
        'cover' => $faker->randomElement([
            'assets/images/idea.jpg',
            'assets/images/idea-1.jpg',
            'assets/images/idea-2.jpg',
            'assets/images/idea-3.jpg',
            'assets/images/idea-4.jpg',
            'assets/images/idea-5.jpg',
            ]),
        'location' => $faker->city,
        'viewer_count' => $faker->numberBetween(0, 10000000),
        'tags' => $faker->words($faker->numberBetween(1, 6), false),
    ];
    if ($array['category'] == 'event') {
        $start_at = $faker->dateTimeBetween('-2 years', '+ 10 years', date_default_timezone_get());
        $finish_at = $faker->dateTimeBetween('-2 years', '+ 10 years', date_default_timezone_get());
        while ($finish_at < $start_at) {
            $start_at = $faker->dateTimeBetween('-2 years', '+ 10 years', date_default_timezone_get());
            $finish_at = $faker->dateTimeBetween('-2 years', '+ 10 years', date_default_timezone_get());
        }
        $array['start_at'] = $start_at;
        $array['finish_at'] = $finish_at;
        if ($finish_at < \Carbon::now()) {
            $array['status'] = 'finish';
        }
    }
    return $array;
});

$factory->define(App\Models\IdeaMedia::class, function (Faker\Generator $faker) {
    return [
        'url' => $faker->randomElement([
                    'assets/images/idea.jpg',
                    'assets/images/idea-1.jpg',
                    'assets/images/idea-2.jpg',
                    'assets/images/idea-3.jpg',
                    'assets/images/idea-4.jpg',
                    'assets/images/idea-5.jpg',
                ]),
        'type' => 'image',
    ];
});
