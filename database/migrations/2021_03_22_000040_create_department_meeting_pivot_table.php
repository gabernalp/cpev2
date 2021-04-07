<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDepartmentMeetingPivotTable extends Migration
{
    public function up()
    {
        Schema::create('department_meeting', function (Blueprint $table) {
            $table->unsignedBigInteger('meeting_id');
            $table->foreign('meeting_id', 'meeting_id_fk_3492280')->references('id')->on('meetings')->onDelete('cascade');
            $table->unsignedBigInteger('department_id');
            $table->foreign('department_id', 'department_id_fk_3492280')->references('id')->on('departments')->onDelete('cascade');
        });
    }
}
