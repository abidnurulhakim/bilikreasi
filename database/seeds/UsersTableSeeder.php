<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\User::class, 20)->create()->each(function ($user) {
            $user->ideas()->saveMany(factory(App\Models\Idea::class, rand($min = 2, $max = 10))->make());
        });
    }
}
