<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToEventsAttendantsTable extends Migration
{
    public function up()
    {
        Schema::table('events_attendants', function (Blueprint $table) {
            $table->unsignedBigInteger('department_id');
            $table->foreign('department_id', 'department_fk_3492268')->references('id')->on('departments');
            $table->unsignedBigInteger('city_id')->nullable();
            $table->foreign('city_id', 'city_fk_3492269')->references('id')->on('cities');
        });
    }
}
