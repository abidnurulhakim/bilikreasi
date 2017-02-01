<?php

use App\Models\User;
use App\Models\Idea;
use App\Services\IdeaService;
use Illuminate\Database\Seeder;

class InvitationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();
        foreach (User::all() as $user) {
            $invitationTotal = $faker->numberBetween(1, 30);
            foreach (Idea::all() as $idea) {
                if ($invitationTotal < 1) {
                    break;
                }
                if (!$idea->isMember($user)) {
                    IdeaService::createInvitation($idea, $user);
                }
                $invitationTotal--;
            }
        }
    }
}
