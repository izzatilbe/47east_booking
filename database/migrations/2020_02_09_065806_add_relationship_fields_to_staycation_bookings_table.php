<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToStaycationBookingsTable extends Migration
{
    public function up()
    {
        Schema::table('staycation_bookings', function (Blueprint $table) {
            $table->unsignedInteger('booked_by_id')->nullable();
            $table->foreign('booked_by_id', 'booked_by_fk_980342')->references('id')->on('customers');
            $table->unsignedInteger('accom_id');
            $table->foreign('accom_id', 'accom_fk_980343')->references('id')->on('accommodations');
        });
    }
}