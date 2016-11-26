<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIdeasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ideas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->string('title');
            $table->string('slug')->unique();
            $table->mediumText('description')->nullable();
            $table->string('category');
            $table->string('status');
            $table->string('cover')->nullable();
            $table->string('location')->nullable();
            $table->timestamp('start_at')->nullable();
            $table->timestamp('finish_at')->nullable();
            $table->integer('member_count')->unsigned()->default(0);
            $table->integer('like_count')->unsigned()->default(0);
            $table->integer('comment_count')->unsigned()->default(0);
            $table->integer('share_count')->unsigned()->default(0);
            $table->boolean('publish')->default(true);
            $table->text('tags')->nullable();
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
        Schema::drop('ideas');
    }
}
