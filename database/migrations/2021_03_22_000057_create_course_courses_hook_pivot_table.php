<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCourseCoursesHookPivotTable extends Migration
{
    public function up()
    {
        Schema::create('course_courses_hook', function (Blueprint $table) {
            $table->unsignedBigInteger('course_id');
            $table->foreign('course_id', 'course_id_fk_3492129')->references('id')->on('courses')->onDelete('cascade');
            $table->unsignedBigInteger('courses_hook_id');
            $table->foreign('courses_hook_id', 'courses_hook_id_fk_3492129')->references('id')->on('courses_hooks')->onDelete('cascade');
        });
    }
}
