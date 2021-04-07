<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChallengeCoursePivotTable extends Migration
{
    public function up()
    {
        Schema::create('challenge_course', function (Blueprint $table) {
            $table->unsignedBigInteger('challenge_id');
            $table->foreign('challenge_id', 'challenge_id_fk_3492147')->references('id')->on('challenges')->onDelete('cascade');
            $table->unsignedBigInteger('course_id');
            $table->foreign('course_id', 'course_id_fk_3492147')->references('id')->on('courses')->onDelete('cascade');
        });
    }
}
