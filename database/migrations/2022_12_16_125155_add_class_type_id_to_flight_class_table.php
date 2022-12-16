<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddClassTypeIdToFlightClassTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('flight_class', function (Blueprint $table) {
            $table->unsignedBigInteger('class_type_id');
            $table->foreign('class_type_id')
            ->references('id')
            ->on('class_type');
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
            $table->dropColumn('class_type_id');
        });
    }
}
