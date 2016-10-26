<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('idea_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->text('content')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('idea_id')
              ->references('id')->on('ideas')
              ->onDelete('cascade');
            $table->foreign('user_id')
              ->references('id')->on('users')
              ->onDelete('cascade');
            $table->index(['idea_id', 'user_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('comments');
    }
}
