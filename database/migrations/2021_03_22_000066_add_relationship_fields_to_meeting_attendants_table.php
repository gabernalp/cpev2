<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToMeetingAttendantsTable extends Migration
{
    public function up()
    {
        Schema::table('meeting_attendants', function (Blueprint $table) {
            $table->unsignedBigInteger('meeting_id')->nullable();
            $table->foreign('meeting_id', 'meeting_fk_3492292')->references('id')->on('meetings');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id', 'user_fk_3492296')->references('id')->on('users');
        });
    }
}
