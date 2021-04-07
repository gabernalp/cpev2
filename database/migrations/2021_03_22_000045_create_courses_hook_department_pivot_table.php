<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoursesHookDepartmentPivotTable extends Migration
{
    public function up()
    {
        Schema::create('courses_hook_department', function (Blueprint $table) {
            $table->unsignedBigInteger('courses_hook_id');
            $table->foreign('courses_hook_id', 'courses_hook_id_fk_3492103')->references('id')->on('courses_hooks')->onDelete('cascade');
            $table->unsignedBigInteger('department_id');
            $table->foreign('department_id', 'department_id_fk_3492103')->references('id')->on('departments')->onDelete('cascade');
        });
    }
}
