<?php

use App\Models\User;
use App\Models\Idea;
use App\Services\IdeaService;
use Illuminate\Database\Seeder;

class IdeaMembersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();
        foreach (Idea::all() as $idea) {
            $users = $faker->randomElements(User::all()->all(), $faker->numberBetween(1, User::count()));
            foreach ($users as $user) {
                IdeaService::join($idea, $user);
            }
        }
    }
}
