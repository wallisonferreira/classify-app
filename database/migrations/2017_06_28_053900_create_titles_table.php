<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTitlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('titles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->integer('trakt')->nullable();
            $table->integer('tvdb')->nullable();
            $table->string('imdb')->nullable();
            $table->integer('tmdb')->nullable();
            $table->integer('year')->nullable();
            $table->string('slug')->nullable()->unique();
            $table->longtext('overview')->nullable();
            $table->string('network')->nullable();
            $table->integer('aired_episodes')->nullable();
            $table->string('poster')->nullable();
            $table->integer('watched')->nullable();
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
        Schema::dropIfExists('titles');
    }
}
