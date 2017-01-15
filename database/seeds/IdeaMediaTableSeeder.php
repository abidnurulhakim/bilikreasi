<?php

use App\Models\Idea;
use App\Models\IdeaMedia;
use Illuminate\Database\Seeder;

class IdeaMediaTableSeeder extends Seeder
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
            $idea->media()->saveMany(factory(IdeaMedia::class, rand($min = 2, $max = 10))->make());
        }
    }
}
