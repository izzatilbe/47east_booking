<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToCoworkingsTable extends Migration
{
    public function up()
    {
        Schema::table('coworkings', function (Blueprint $table) {
            $table->unsignedInteger('booked_by_id');
            $table->foreign('booked_by_id', 'booked_by_fk_980398')->references('id')->on('customers');
        });
    }
}