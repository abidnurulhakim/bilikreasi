<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('discuss_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->text('content');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('discuss_id')
              ->references('id')->on('discusses')
              ->onDelete('cascade');
            $table->foreign('user_id')
              ->references('id')->on('users')
              ->onDelete('cascade');
            $table->index(['discuss_id', 'user_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('messages');
    }
}
