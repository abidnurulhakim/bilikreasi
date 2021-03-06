<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        $this->call(IdeaMediaTableSeeder::class);
        $this->call(IdeaMembersTableSeeder::class);
        $this->call(InvitationsTableSeeder::class);
        $this->call(LikesTableSeeder::class);
        $this->call(MessagesTableSeeder::class);
    }
}
