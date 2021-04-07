<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToBadgesUsersTable extends Migration
{
    public function up()
    {
        Schema::table('badges_users', function (Blueprint $table) {
            $table->unsignedBigInteger('programmed_course_id')->nullable();
            $table->foreign('programmed_course_id', 'programmed_course_fk_3492333')->references('id')->on('course_schedules');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id', 'user_fk_3492334')->references('id')->on('users');
            $table->unsignedBigInteger('badge_id');
            $table->foreign('badge_id', 'badge_fk_3492335')->references('id')->on('badges');
            $table->unsignedBigInteger('created_by_id')->nullable();
            $table->foreign('created_by_id', 'created_by_fk_3492339')->references('id')->on('users');
        });
    }
}
