<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVenueVenueCategoryPivotTable extends Migration
{
    public function up()
    {
        Schema::create('venue_venue_category', function (Blueprint $table) {
            $table->unsignedInteger('venue_id');
            $table->foreign('venue_id', 'venue_id_fk_979567')->references('id')->on('venues')->onDelete('cascade');
            $table->unsignedInteger('venue_category_id');
            $table->foreign('venue_category_id', 'venue_category_id_fk_979567')->references('id')->on('venue_categories')->onDelete('cascade');
        });
    }
}