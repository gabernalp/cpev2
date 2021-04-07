<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCourseDepartmentPivotTable extends Migration
{
    public function up()
    {
        Schema::create('course_department', function (Blueprint $table) {
            $table->unsignedBigInteger('course_id');
            $table->foreign('course_id', 'course_id_fk_3492127')->references('id')->on('courses')->onDelete('cascade');
            $table->unsignedBigInteger('department_id');
            $table->foreign('department_id', 'department_id_fk_3492127')->references('id')->on('departments')->onDelete('cascade');
        });
    }
}
