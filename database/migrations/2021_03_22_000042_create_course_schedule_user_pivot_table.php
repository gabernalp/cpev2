<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCourseScheduleUserPivotTable extends Migration
{
    public function up()
    {
        Schema::create('course_schedule_user', function (Blueprint $table) {
            $table->unsignedBigInteger('course_schedule_id');
            $table->foreign('course_schedule_id', 'course_schedule_id_fk_3492177')->references('id')->on('course_schedules')->onDelete('cascade');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id', 'user_id_fk_3492177')->references('id')->on('users')->onDelete('cascade');
        });
    }
}
