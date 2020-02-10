<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoworkingsTable extends Migration
{
    public function up()
    {
        Schema::create('coworkings', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('duration')->nullable();
            $table->integer('quantity');
            $table->decimal('total_charge', 15, 2);
            $table->string('booking_status');
            $table->date('date_start');
            $table->date('date_end');
            $table->string('pass_type');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}