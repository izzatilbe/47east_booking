<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToVenueBookingsTable extends Migration
{
    public function up()
    {
        Schema::table('venue_bookings', function (Blueprint $table) {
            $table->unsignedInteger('booked_by_id')->nullable();
            $table->foreign('booked_by_id', 'booked_by_fk_980319')->references('id')->on('customers');
        });
    }
}