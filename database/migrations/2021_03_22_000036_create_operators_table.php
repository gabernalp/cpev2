<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOperatorsTable extends Migration
{
    public function up()
    {
        Schema::create('operators', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->nullable();
            $table->longText('observaciones')->nullable();
            $table->string('nit')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
