<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToDormitoryBookingsTable extends Migration
{
    public function up()
    {
        Schema::table('dormitory_bookings', function (Blueprint $table) {
            $table->unsignedInteger('booked_by_id')->nullable();
            $table->foreign('booked_by_id', 'booked_by_fk_980300')->references('id')->on('customers');
            $table->unsignedInteger('accom_id');
            $table->foreign('accom_id', 'accom_fk_980314')->references('id')->on('accommodations');
        });
    }
}