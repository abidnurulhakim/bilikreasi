<?php

use App\Models\User;
use App\Models\Idea;
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
        factory(User::class, 40)->create()->each(function ($user) {
            $user->ideas()->saveMany(factory(Idea::class, rand($min = 2, $max = 10))->make());
        });
    }
}
