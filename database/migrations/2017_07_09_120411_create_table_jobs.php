<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableJobs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jobs', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedSmallInteger('user_id');
            $table->enum('type', ['freelance', 'contract', 'cdi']);
            $table->string('slug')->nullable();
            $table->string('company')->nullable();
            $table->string('title')->nullable();
            $table->string('job_title')->nullable();
            $table->text('description')->nullable();
            $table->string('url')->nullable();
            $table->unsignedTinyInteger('active');
            $table->string('start_date');
            $table->string('end_date');

            //$table->foreign('user_id')->references('id')->on('users');

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
        Schema::dropIfExists('jobs');
    }
}
