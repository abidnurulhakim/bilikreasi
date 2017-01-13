<?php

use App\Models\User;
use App\Services\IdeaService;
use Illuminate\Database\Seeder;

class LikesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();
        foreach (\App\Models\Idea::all() as $idea) {
            $users = $faker->randomElements(User::all()->all(), $faker->numberBetween(1, User::count()));
            foreach ($users as $user) {
                IdeaService::like($idea, $user);
            }
        }
    }
}
