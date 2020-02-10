<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStaycationBookingsTable extends Migration
{
    public function up()
    {
        Schema::create('staycation_bookings', function (Blueprint $table) {
            $table->increments('id');
            $table->date('check_in');
            $table->date('check_out');
            $table->integer('duration')->nullable();
            $table->integer('quantity')->nullable();
            $table->decimal('room_charge', 15, 2);
            $table->decimal('misc_charge', 15, 2)->nullable();
            $table->decimal('total_charge', 15, 2);
            $table->string('package')->nullable();
            $table->string('booking_status');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}