<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVenueVenueAmenityPivotTable extends Migration
{
    public function up()
    {
        Schema::create('venue_venue_amenity', function (Blueprint $table) {
            $table->unsignedInteger('venue_id');
            $table->foreign('venue_id', 'venue_id_fk_979627')->references('id')->on('venues')->onDelete('cascade');
            $table->unsignedInteger('venue_amenity_id');
            $table->foreign('venue_amenity_id', 'venue_amenity_id_fk_979627')->references('id')->on('venue_amenities')->onDelete('cascade');
        });
    }
}