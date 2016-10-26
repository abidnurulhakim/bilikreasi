<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('reset_password');
            $table->boolean('confirmed')->default(false);
            $table->bigInteger('photo_profile')->unsigned();
            $table->string('role')->default('user');
            $table->timestamp('last_login_at')->nullable();
            $table->ipAddress('last_login_ip_address')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('photo_profile')
              ->references('id')->on('attachments')
              ->onDelete('cascade');
        }); 
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('users');
    }
}
