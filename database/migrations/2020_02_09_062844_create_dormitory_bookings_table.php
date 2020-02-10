<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDormitoryBookingsTable extends Migration
{
    public function up()
    {
        Schema::create('dormitory_bookings', function (Blueprint $table) {
            $table->increments('id');
            $table->decimal('room_charge', 15, 2);
            $table->decimal('misc_charge', 15, 2)->nullable();
            $table->decimal('total_charge', 15, 2);
            $table->string('booking_status');
            $table->string('duration_months');
            $table->date('move_in');
            $table->string('payment_type')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}