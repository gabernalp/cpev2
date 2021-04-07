<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToCoursesUsersTable extends Migration
{
    public function up()
    {
        Schema::table('courses_users', function (Blueprint $table) {
            $table->unsignedBigInteger('start_date_id');
            $table->foreign('start_date_id', 'start_date_fk_3492197')->references('id')->on('course_schedules');
            $table->unsignedBigInteger('created_by_id')->nullable();
            $table->foreign('created_by_id', 'created_by_fk_3492202')->references('id')->on('users');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id', 'user_fk_3492204')->references('id')->on('users');
        });
    }
}
