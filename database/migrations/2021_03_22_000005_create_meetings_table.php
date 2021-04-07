<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMeetingsTable extends Migration
{
    public function up()
    {
        Schema::create('meetings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title')->nullable();
            $table->longText('description')->nullable();
            $table->date('date');
            $table->string('link')->nullable();
            $table->boolean('confirmed')->default(0)->nullable();
            $table->longText('observaciones')->nullable();
            $table->time('time');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
