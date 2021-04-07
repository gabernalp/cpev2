<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoursesHookEntityPivotTable extends Migration
{
    public function up()
    {
        Schema::create('courses_hook_entity', function (Blueprint $table) {
            $table->unsignedBigInteger('courses_hook_id');
            $table->foreign('courses_hook_id', 'courses_hook_id_fk_3492110')->references('id')->on('courses_hooks')->onDelete('cascade');
            $table->unsignedBigInteger('entity_id');
            $table->foreign('entity_id', 'entity_id_fk_3492110')->references('id')->on('entities')->onDelete('cascade');
        });
    }
}
