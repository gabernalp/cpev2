<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoursesUsersTable extends Migration
{
    public function up()
    {
        Schema::create('courses_users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('group')->nullable();
            $table->date('end_date')->nullable();
            $table->string('course_name');
            $table->string('challenges')->nullable();
            $table->string('feedbacks')->nullable();
            $table->string('badges')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
