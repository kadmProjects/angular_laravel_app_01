<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('status');
            $table->integer('created_by');
            $table->timestamp('password_set_date')->nullable();
            $table->timestamp('password_expire_date')->nullable();
            $table->timestamp('first_login_date')->nullable();
            $table->timestamp('last_login_date')->nullable();
            $table->string('temp_password')->nullable();
            $table->timestamp('temp_password_set_date')->nullable();
            $table->timestamp('temp_password_expire_date')->nullable();
            $table->rememberToken();
            $table->timestamps();
            $table->foreign('created_by')
                ->references('id')
                ->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
