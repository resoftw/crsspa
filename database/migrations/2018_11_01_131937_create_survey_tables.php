<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSurveyTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('surveys', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name',100);
            $table->text('description')->nullable();
            $table->unsignedInteger('created_by');
            $table->date('start');
            $table->date('end');
            $table->timestamps();
        });

        Schema::create('survey_sections',function(Blueprint $table){
            $table->increments('id');
            $table->unsignedInteger('survey_id');
            $table->string('title',100);
            $table->string('subtitle')->nullable();
        });

        Schema::create('questions',function(Blueprint $table){
            $table->increments('id');
            $table->unsignedInteger('survey_section_id');
            $table->text('title');
        });

        Schema::create('answers',function(Blueprint $table){
            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->unsignedInteger("question_id");
            $table->dateTime('answered_at');
            $table->integer('answer');
        });


        Schema::create('survey_user',function(Blueprint $table){
            $table->increments('id');
            $table->unsignedInteger('survey_id');
            $table->unsignedInteger('user_id');
            $table->dateTime('completed_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('questions');
        Schema::dropIfExists('survey_sections');
        Schema::dropIfExists('surver_headers');
    }
}
