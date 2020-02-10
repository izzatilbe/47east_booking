<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVenueBookingsTable extends Migration
{
    public function up()
    {
        Schema::create('venue_bookings', function (Blueprint $table) {
            $table->increments('id');
            $table->decimal('room_charge', 15, 2);
            $table->decimal('misc_charge', 15, 2)->nullable();
            $table->decimal('total_charge', 15, 2);
            $table->string('booking_status');
            $table->datetime('datetime_start');
            $table->datetime('datetime_end');
            $table->string('duration');
            $table->string('payment_type')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}