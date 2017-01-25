<?php

use App\Models\User;
use App\Models\Discussion;
use App\Services\DiscussionService;
use Illuminate\Database\Seeder;

class MessagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();
        foreach (Discussion::all() as $discussion) {
            $participants = $discussion->participants->all();
            $totalMessage = $faker->numberBetween(10, 75);
            for ($i = 0; $i < $totalMessage ; $i++) {
                $user = $faker->randomElement($participants);
                $content = $faker->text(255);
                DiscussionService::sendMessage($discussion, $user, $content);
            }
        }
    }
}
