<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccomTagAccommodationPivotTable extends Migration
{
    public function up()
    {
        Schema::create('accom_tag_accommodation', function (Blueprint $table) {
            $table->unsignedInteger('accommodation_id');
            $table->foreign('accommodation_id', 'accommodation_id_fk_979540')->references('id')->on('accommodations')->onDelete('cascade');
            $table->unsignedInteger('accom_tag_id');
            $table->foreign('accom_tag_id', 'accom_tag_id_fk_979540')->references('id')->on('accom_tags')->onDelete('cascade');
        });
    }
}