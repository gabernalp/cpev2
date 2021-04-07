<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserChainBlocksTable extends Migration
{
    public function up()
    {
        Schema::create('user_chain_blocks', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('media')->nullable();
            $table->longText('text')->nullable();
            $table->string('broker')->nullable();
            $table->string('id_mensaje')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
