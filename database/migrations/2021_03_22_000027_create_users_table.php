<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->nullable();
            $table->string('email')->nullable()->unique();
            $table->datetime('email_verified_at')->nullable();
            $table->string('password')->nullable();
            $table->string('remember_token')->nullable();
            $table->boolean('verified')->default(0)->nullable();
            $table->datetime('verified_at')->nullable();
            $table->string('verification_token')->nullable();
            $table->string('last_name')->nullable();
            $table->string('gender')->nullable();
            $table->string('phone')->nullable()->unique();
            $table->string('phone_2')->nullable();
            $table->string('zona')->nullable();
            $table->string('etnia')->nullable();
            $table->string('academic_background')->nullable();
            $table->string('modality')->nullable();
            $table->integer('document')->nullable()->unique();
            $table->boolean('newsletter_subscription')->default(0)->nullable();
            $table->string('entity')->nullable();
            $table->string('place_role')->nullable();
            $table->string('labour_role')->nullable();
            $table->longText('motivation')->nullable();
            $table->string('experience')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
