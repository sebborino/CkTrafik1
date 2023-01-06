<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePriceAndTravelersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('price_and_travelers', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('price_id');
            $table->foreign('price_id')
            ->references('id')
            ->on('prices');

            $table->unsignedBigInteger('traveler_id');
            $table->foreign('traveler_id')
            ->references('id')
            ->on('traveler_types');
            
            $table->decimal('price',14,2);
            $table->decimal('more_price',14,2);

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
        Schema::dropIfExists('price_and_travelers');
    }
}
