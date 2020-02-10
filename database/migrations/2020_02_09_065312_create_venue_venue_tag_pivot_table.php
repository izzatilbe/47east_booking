<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVenueVenueTagPivotTable extends Migration
{
    public function up()
    {
        Schema::create('venue_venue_tag', function (Blueprint $table) {
            $table->unsignedInteger('venue_id');
            $table->foreign('venue_id', 'venue_id_fk_979568')->references('id')->on('venues')->onDelete('cascade');
            $table->unsignedInteger('venue_tag_id');
            $table->foreign('venue_tag_id', 'venue_tag_id_fk_979568')->references('id')->on('venue_tags')->onDelete('cascade');
        });
    }
}