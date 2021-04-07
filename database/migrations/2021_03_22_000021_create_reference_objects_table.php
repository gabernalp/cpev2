<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReferenceObjectsTable extends Migration
{
    public function up()
    {
        Schema::create('reference_objects', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title')->nullable();
            $table->string('link')->nullable();
            $table->string('image')->nullable();
            $table->string('comments')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
