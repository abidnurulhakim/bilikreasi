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
            $table->string('username')->unique();
            $table->string('email')->unique();
            $table->string('gender');
            $table->date('birthday')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('hash_password');
            $table->string('secret_password');
            $table->string('reset_password')->nullable();
            $table->string('remember_token')->nullable();
            $table->boolean('confirmed')->default(false);
            $table->text('photo')->nullable();
            $table->string('role')->default('user');
            $table->timestamp('last_login_at')->nullable();
            $table->ipAddress('last_login_ip_address')->nullable();
            $table->string('profession')->nullable();
            $table->string('live_at')->nullable();
            $table->timestamp('freeze')->nullable();
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
        Schema::drop('users');
    }
}
