<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToChallengesUsersTable extends Migration
{
    public function up()
    {
        Schema::table('challenges_users', function (Blueprint $table) {
            $table->unsignedBigInteger('challenge_id')->nullable();
            $table->foreign('challenge_id', 'challenge_fk_3492210')->references('id')->on('challenges');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id', 'user_fk_3492211')->references('id')->on('users');
            $table->unsignedBigInteger('referencetype_id')->nullable();
            $table->foreign('referencetype_id', 'referencetype_fk_3492212')->references('id')->on('reference_types');
            $table->unsignedBigInteger('created_by_id')->nullable();
            $table->foreign('created_by_id', 'created_by_fk_3492219')->references('id')->on('users');
            $table->unsignedBigInteger('courseschedule_id')->nullable();
            $table->foreign('courseschedule_id', 'courseschedule_fk_3492222')->references('id')->on('course_schedules');
        });
    }
}
