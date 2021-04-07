<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChallengesTable extends Migration
{
    public function up()
    {
        Schema::create('challenges', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('description')->nullable();
            $table->longText('goal')->nullable();
            $table->string('limit_time')->nullable();
            $table->integer('hours_adding');
            $table->string('challenge_action')->nullable();
            $table->longText('action_detail')->nullable();
            $table->string('capsule')->nullable();
            $table->longText('capsule_content')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
