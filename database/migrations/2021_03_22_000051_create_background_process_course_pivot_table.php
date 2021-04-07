<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBackgroundProcessCoursePivotTable extends Migration
{
    public function up()
    {
        Schema::create('background_process_course', function (Blueprint $table) {
            $table->unsignedBigInteger('course_id');
            $table->foreign('course_id', 'course_id_fk_3492117')->references('id')->on('courses')->onDelete('cascade');
            $table->unsignedBigInteger('background_process_id');
            $table->foreign('background_process_id', 'background_process_id_fk_3492117')->references('id')->on('background_processes')->onDelete('cascade');
        });
    }
}
