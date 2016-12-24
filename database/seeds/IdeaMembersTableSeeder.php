<?php

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
        foreach (\App\Models\Idea::all() as $idea) {
            $users = $faker->randomElements([1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20], $faker->numberBetween($min = 1, $max = 20));
        	$idea->members()->attach(collect($users)->diff([$idea->user_id])->all());
        }
    }
}
