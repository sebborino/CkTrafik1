<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFlightClassCategoryToFlightClass extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('flight_class', function (Blueprint $table) {
            $table->unsignedBigInteger('flight_class_category_id');
            $table->foreign('flight_class_category_id')
            ->references('id')
            ->on('flight_class_categories');
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
            $table->dropColumn('flight_class_category_id');
        });
    }
}
