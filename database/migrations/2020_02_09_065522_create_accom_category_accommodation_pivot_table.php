<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccomCategoryAccommodationPivotTable extends Migration
{
    public function up()
    {
        Schema::create('accom_category_accommodation', function (Blueprint $table) {
            $table->unsignedInteger('accommodation_id');
            $table->foreign('accommodation_id', 'accommodation_id_fk_979450')->references('id')->on('accommodations')->onDelete('cascade');
            $table->unsignedInteger('accom_category_id');
            $table->foreign('accom_category_id', 'accom_category_id_fk_979450')->references('id')->on('accom_categories')->onDelete('cascade');
        });
    }
}