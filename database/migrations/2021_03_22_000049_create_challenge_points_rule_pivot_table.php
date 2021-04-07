<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChallengePointsRulePivotTable extends Migration
{
    public function up()
    {
        Schema::create('challenge_points_rule', function (Blueprint $table) {
            $table->unsignedBigInteger('challenge_id');
            $table->foreign('challenge_id', 'challenge_id_fk_3492156')->references('id')->on('challenges')->onDelete('cascade');
            $table->unsignedBigInteger('points_rule_id');
            $table->foreign('points_rule_id', 'points_rule_id_fk_3492156')->references('id')->on('points_rules')->onDelete('cascade');
        });
    }
}
