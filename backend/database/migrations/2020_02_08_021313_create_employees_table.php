<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('address');
            $table->string('dob');
            $table->string('nic');
            $table->unsignedBigInteger('job_title_id');
            $table->unsignedBigInteger('gender_id');
            $table->integer('primary_mobile_no');
            $table->integer('secondary_mobile_no');
            $table->integer('home_phone_no');
            $table->unsignedBigInteger('created_user_id');
            $table->foreign('job_title_id')
                ->references('id')
                ->on('job_titles');
            $table->foreign('gender_id')
                ->references('id')
                ->on('genders');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employees');
    }
}
