<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReferenceObjectTagPivotTable extends Migration
{
    public function up()
    {
        Schema::create('reference_object_tag', function (Blueprint $table) {
            $table->unsignedBigInteger('reference_object_id');
            $table->foreign('reference_object_id', 'reference_object_id_fk_3492082')->references('id')->on('reference_objects')->onDelete('cascade');
            $table->unsignedBigInteger('tag_id');
            $table->foreign('tag_id', 'tag_id_fk_3492082')->references('id')->on('tags')->onDelete('cascade');
        });
    }
}
