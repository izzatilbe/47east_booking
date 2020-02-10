<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToEmployeesTable extends Migration
{
    public function up()
    {
        Schema::table('employees', function (Blueprint $table) {
            $table->unsignedInteger('business_unit_id')->nullable();
            $table->foreign('business_unit_id', 'business_unit_fk_979854')->references('id')->on('business_units');
        });
    }
}