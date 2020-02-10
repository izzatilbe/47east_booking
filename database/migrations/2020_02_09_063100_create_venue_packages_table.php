<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVenuePackagesTable extends Migration
{
    public function up()
    {
        Schema::create('venue_packages', function (Blueprint $table) {
            $table->increments('id');
            $table->decimal('total_package_charge', 15, 2);
            $table->timestamps();
            $table->softDeletes();
        });
    }
}