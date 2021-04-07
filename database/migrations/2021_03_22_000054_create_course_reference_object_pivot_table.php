<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCourseReferenceObjectPivotTable extends Migration
{
    public function up()
    {
        Schema::create('course_reference_object', function (Blueprint $table) {
            $table->unsignedBigInteger('course_id');
            $table->foreign('course_id', 'course_id_fk_3492126')->references('id')->on('courses')->onDelete('cascade');
            $table->unsignedBigInteger('reference_object_id');
            $table->foreign('reference_object_id', 'reference_object_id_fk_3492126')->references('id')->on('reference_objects')->onDelete('cascade');
        });
    }
}
