<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSkillTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('skills', function (Blueprint $table) {
            $table->tinyIncrements('id');
            $table->unsignedSmallInteger('user_id');
            $table->string('slug');
            $table->string('title');
            $table->text('description');
            $table->enum('type', ['php', 'js', 'html', 'css', 'server']);
            $table->unsignedTinyInteger('active');
            $table->foreign('user_id')->references('id')->on('users');
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
        Schema::dropIfExists('skills');
    }
}
