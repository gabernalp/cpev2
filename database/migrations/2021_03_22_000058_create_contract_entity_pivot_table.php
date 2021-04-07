<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContractEntityPivotTable extends Migration
{
    public function up()
    {
        Schema::create('contract_entity', function (Blueprint $table) {
            $table->unsignedBigInteger('contract_id');
            $table->foreign('contract_id', 'contract_id_fk_3492138')->references('id')->on('contracts')->onDelete('cascade');
            $table->unsignedBigInteger('entity_id');
            $table->foreign('entity_id', 'entity_id_fk_3492138')->references('id')->on('entities')->onDelete('cascade');
        });
    }
}
