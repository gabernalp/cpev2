<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoursesHooksTable extends Migration
{
    public function up()
    {
        Schema::create('courses_hooks', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->longText('description')->nullable();
            $table->longText('requirements')->nullable();
            $table->string('link')->nullable();
            $table->boolean('priorized')->default(0)->nullable();
            $table->string('educational_level')->nullable();
            $table->boolean('exclusive')->default(0)->nullable();
            $table->string('educational_level_exclusive')->nullable();
            $table->boolean('community')->default(0)->nullable();
            $table->boolean('institutional')->default(0)->nullable();
            $table->string('educational_group')->nullable();
            $table->boolean('coordinator')->default(0)->nullable();
            $table->string('specific_category')->nullable();
            $table->boolean('family')->default(0)->nullable();
            $table->boolean('intercultural')->default(0)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
