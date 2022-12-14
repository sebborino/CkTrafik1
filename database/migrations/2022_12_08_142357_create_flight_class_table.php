<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFlightClassTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('flight_class', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('class_code');
            $table->decimal('price',14,2);
            $table->decimal('more_price',14,2);
            $table->decimal('more_rate',14,2);

            $table->unsignedBigInteger('flight_category_id');
            $table->foreign('flight_category_id')
            ->references('id')
            ->on('flight_categories');

            $table->unsignedBigInteger('destination_id');
            $table->foreign('destination_id')
            ->references('id')
            ->on('destinations');

            $table->unsignedBigInteger('currency_id');
            $table->foreign('currency_id')
            ->references('id')
            ->on('currencies');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('flight_class');
    }
}
