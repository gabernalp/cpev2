<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBackgroundProcessTagPivotTable extends Migration
{
    public function up()
    {
        Schema::create('background_process_tag', function (Blueprint $table) {
            $table->unsignedBigInteger('background_process_id');
            $table->foreign('background_process_id', 'background_process_id_fk_3492063')->references('id')->on('background_processes')->onDelete('cascade');
            $table->unsignedBigInteger('tag_id');
            $table->foreign('tag_id', 'tag_id_fk_3492063')->references('id')->on('tags')->onDelete('cascade');
        });
    }
}
