<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccomAmenityAccommodationPivotTable extends Migration
{
    public function up()
    {
        Schema::create('accom_amenity_accommodation', function (Blueprint $table) {
            $table->unsignedInteger('accommodation_id');
            $table->foreign('accommodation_id', 'accommodation_id_fk_979626')->references('id')->on('accommodations')->onDelete('cascade');
            $table->unsignedInteger('accom_amenity_id');
            $table->foreign('accom_amenity_id', 'accom_amenity_id_fk_979626')->references('id')->on('accom_amenities')->onDelete('cascade');
        });
    }
}