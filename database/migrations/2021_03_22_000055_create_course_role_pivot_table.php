<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCourseRolePivotTable extends Migration
{
    public function up()
    {
        Schema::create('course_role', function (Blueprint $table) {
            $table->unsignedBigInteger('course_id');
            $table->foreign('course_id', 'course_id_fk_3492128')->references('id')->on('courses')->onDelete('cascade');
            $table->unsignedBigInteger('role_id');
            $table->foreign('role_id', 'role_id_fk_3492128')->references('id')->on('roles')->onDelete('cascade');
        });
    }
}
