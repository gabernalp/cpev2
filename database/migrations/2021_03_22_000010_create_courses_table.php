<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoursesTable extends Migration
{
    public function up()
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->longText('description');
            $table->longText('goal');
            $table->boolean('support_required')->default(0)->nullable();
            $table->string('hours')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
