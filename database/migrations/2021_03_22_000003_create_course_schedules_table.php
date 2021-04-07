<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCourseSchedulesTable extends Migration
{
    public function up()
    {
        Schema::create('course_schedules', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('start_date');
            $table->integer('tutor_capacity');
            $table->string('iterations_number')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
