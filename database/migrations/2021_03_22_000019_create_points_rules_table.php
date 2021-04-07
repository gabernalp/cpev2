<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePointsRulesTable extends Migration
{
    public function up()
    {
        Schema::create('points_rules', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('points_item');
            $table->integer('points')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
