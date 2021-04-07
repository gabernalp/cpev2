<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventsSchedulesTable extends Migration
{
    public function up()
    {
        Schema::create('events_schedules', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->longText('description');
            $table->datetime('date')->nullable();
            $table->string('link')->nullable();
            $table->longText('newsletter')->nullable();
            $table->string('invitados')->nullable();
            $table->string('title')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
