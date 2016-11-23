<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePopularIdea extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('popular_ideas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('popular_id')->unsigned();
            $table->integer('idea_id')->unsigned();
            $table->integer('order_number')->default(9);
            $table->timestamps();
            $table->softDeletes();
        }); 
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('popular_ideas');
    }
}
