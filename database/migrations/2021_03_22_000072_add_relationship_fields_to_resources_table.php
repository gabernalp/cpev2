<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToResourcesTable extends Migration
{
    public function up()
    {
        Schema::table('resources', function (Blueprint $table) {
            $table->unsignedBigInteger('resourcescategory_id');
            $table->foreign('resourcescategory_id', 'resourcescategory_fk_3492242')->references('id')->on('resources_categories');
            $table->unsignedBigInteger('resourcessubcategory_id')->nullable();
            $table->foreign('resourcessubcategory_id', 'resourcessubcategory_fk_3492243')->references('id')->on('resources_subcategories');
            $table->unsignedBigInteger('subcategoriesset_id')->nullable();
            $table->foreign('subcategoriesset_id', 'subcategoriesset_fk_3492244')->references('id')->on('subcategories_sets');
        });
    }
}
