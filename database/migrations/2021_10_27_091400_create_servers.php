<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('servers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->foreignId('game_id');
            $table->unsignedBigInteger('banner_id')->nullable();
            $table->foreign('banner_id')->references('id')->on('images');
            $table->unsignedBigInteger('logo_id')->nullable();
            $table->foreign('logo_id')->references('id')->on('images');
            $table->string('name');
            $table->string('slug');
            $table->string('ip')->nullable();
            $table->integer('port')->nullable();
            $table->integer('query')->nullable();
            $table->unsignedBigInteger('host_id')->nullable();
            $table->foreign('host_id')->references('id')->on('languages');
            $table->string('website')->nullable();
            $table->string('slots')->nullable();
            $table->boolean('access')->default(0);
            $table->longText('description')->nullable();
            $table->string('discord')->nullable();
            $table->string('teamspeak')->nullable();
            $table->string('mumble')->nullable();
            $table->string('twitch')->nullable();
            $table->string('youtube')->nullable();
            $table->bigInteger('vote')->default(0);
            $table->bigInteger('click')->default(0);
            $table->string('api');
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
        Schema::dropIfExists('servers');
    }
}
