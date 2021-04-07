<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMeetingTagPivotTable extends Migration
{
    public function up()
    {
        Schema::create('meeting_tag', function (Blueprint $table) {
            $table->unsignedBigInteger('meeting_id');
            $table->foreign('meeting_id', 'meeting_id_fk_3492281')->references('id')->on('meetings')->onDelete('cascade');
            $table->unsignedBigInteger('tag_id');
            $table->foreign('tag_id', 'tag_id_fk_3492281')->references('id')->on('tags')->onDelete('cascade');
        });
    }
}
