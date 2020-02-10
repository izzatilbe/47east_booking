<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccommodationVenuePackagePivotTable extends Migration
{
    public function up()
    {
        Schema::create('accommodation_venue_package', function (Blueprint $table) {
            $table->unsignedInteger('venue_package_id');
            $table->foreign('venue_package_id', 'venue_package_id_fk_980335')->references('id')->on('venue_packages')->onDelete('cascade');
            $table->unsignedInteger('accommodation_id');
            $table->foreign('accommodation_id', 'accommodation_id_fk_980335')->references('id')->on('accommodations')->onDelete('cascade');
        });
    }
}