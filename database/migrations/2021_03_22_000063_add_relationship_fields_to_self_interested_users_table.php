<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToSelfInterestedUsersTable extends Migration
{
    public function up()
    {
        Schema::table('self_interested_users', function (Blueprint $table) {
            $table->unsignedBigInteger('documenttype_id');
            $table->foreign('documenttype_id', 'documenttype_fk_3492304')->references('id')->on('document_types');
            $table->unsignedBigInteger('department_id')->nullable();
            $table->foreign('department_id', 'department_fk_3492310')->references('id')->on('departments');
            $table->unsignedBigInteger('city_id')->nullable();
            $table->foreign('city_id', 'city_fk_3492311')->references('id')->on('cities');
        });
    }
}
