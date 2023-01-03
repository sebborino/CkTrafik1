<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTravelerTypeToFlightClass extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('flight_class', function (Blueprint $table) {
            $table->unsignedBigInteger('traveler_type_id');
            $table->foreign('traveler_type_id')
            ->references('id')
            ->on('traveler_types');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('flight_class', function (Blueprint $table) {
            //
        });
    }
}
