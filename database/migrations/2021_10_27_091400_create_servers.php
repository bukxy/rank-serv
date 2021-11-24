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
            $table->string('name')->unique();
            $table->string('ip')->unique();
            $table->string('port')->unique();
            $table->string('website')->nullable();
            $table->string('slots');
            $table->string('access');
            $table->string('description')->nullable();
            $table->json('tag');
            $table->json('lang');
            $table->string('discord')->nullable();
            $table->string('teamspeak')->nullable();
            $table->string('mumble')->nullable();
            $table->string('twitch')->nullable();
            $table->string('youtube')->nullable();
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
        Schema::dropIfExists('game');
    }
}
