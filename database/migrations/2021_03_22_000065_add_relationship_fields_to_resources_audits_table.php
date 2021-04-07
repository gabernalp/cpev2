<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToResourcesAuditsTable extends Migration
{
    public function up()
    {
        Schema::table('resources_audits', function (Blueprint $table) {
            $table->unsignedBigInteger('recurso_id')->nullable();
            $table->foreign('recurso_id', 'recurso_fk_3492326')->references('id')->on('resources');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id', 'user_fk_3492328')->references('id')->on('users');
        });
    }
}
