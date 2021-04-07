<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCourseOperatorPivotTable extends Migration
{
    public function up()
    {
        Schema::create('course_operator', function (Blueprint $table) {
            $table->unsignedBigInteger('course_id');
            $table->foreign('course_id', 'course_id_fk_3492125')->references('id')->on('courses')->onDelete('cascade');
            $table->unsignedBigInteger('operator_id');
            $table->foreign('operator_id', 'operator_id_fk_3492125')->references('id')->on('operators')->onDelete('cascade');
        });
    }
}
