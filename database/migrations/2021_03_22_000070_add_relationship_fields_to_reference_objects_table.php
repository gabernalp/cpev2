<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToReferenceObjectsTable extends Migration
{
    public function up()
    {
        Schema::table('reference_objects', function (Blueprint $table) {
            $table->unsignedBigInteger('referencetype_id')->nullable();
            $table->foreign('referencetype_id', 'referencetype_fk_3492077')->references('id')->on('reference_types');
        });
    }
}
