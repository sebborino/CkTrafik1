<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDepartureDurationStopoverToTravelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('travels', function (Blueprint $table) {
            $table->time('departure_duration_stopover')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('travels', function (Blueprint $table) {
            $table->dropColumn('departure_duration_stopover')->nullable();
        });
    }
}
