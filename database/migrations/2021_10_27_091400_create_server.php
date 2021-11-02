<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServer extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('server', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->unsignedbigInteger('game_id');
            $table->foreign('game_id')
                ->references('id')
                ->on('game')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->string('name')->unique();
            $table->string('ip');
            $table->string('port');
            $table->string('website')->nullable();
            $table->string('slots');
            $table->string('acces');
            $table->string('description');
            $table->json('tag');
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
