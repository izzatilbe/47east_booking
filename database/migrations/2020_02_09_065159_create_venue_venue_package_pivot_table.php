<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVenueVenuePackagePivotTable extends Migration
{
    public function up()
    {
        Schema::create('venue_venue_package', function (Blueprint $table) {
            $table->unsignedInteger('venue_package_id');
            $table->foreign('venue_package_id', 'venue_package_id_fk_980336')->references('id')->on('venue_packages')->onDelete('cascade');
            $table->unsignedInteger('venue_id');
            $table->foreign('venue_id', 'venue_id_fk_980336')->references('id')->on('venues')->onDelete('cascade');
        });
    }
}