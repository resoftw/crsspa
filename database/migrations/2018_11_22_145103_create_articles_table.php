<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tags',function(Blueprint $table){
            $table->increments('id');
            $table->string('name');
        });


        Schema::create('articles', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('author_id')->default(0);
            $table->string('title');
            $table->string('subtitle');
            $table->text('content');
            $table->string('cover');
            $table->unsignedInteger('view_count')->default(0);
            $table->timestamps();
        });

        Schema::create('taggables', function (Blueprint $table) {
            $table->unsignedInteger('tag_id');
            $table->morphs('taggable');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('taggables');
        Schema::dropIfExists('articles');
        Schema::dropIfExists('tags');
    }
}
