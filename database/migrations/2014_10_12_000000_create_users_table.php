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
            $table->smallIncrements('id');
            $table->string('firstname');
            $table->string('lastname');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('address')->nullable();
            $table->text('about_me')->nullable();
            $table->string('postcode')->nullable();
            $table->string('city')->nullable();
            $table->string('phone')->nullable();
            $table->string('job_title')->nullable();
            $table->enum('type', ['admin', 'visitor', 'headhunter']);
            $table->unsignedTinyInteger('active');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
