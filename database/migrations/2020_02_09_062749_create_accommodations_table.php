<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccommodationsTable extends Migration
{
    public function up()
    {
        Schema::create('accommodations', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->nullable();
            $table->longText('description');
            $table->decimal('price', 15, 2)->nullable();
            $table->string('short_description');
            $table->integer('capacity')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}