<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAirportAndTaxesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('airport_and_taxes', function (Blueprint $table) {
            $table->id();
            $table->decimal('tax',14,2);
            $table->char('tax_code',3);

            $table->unsignedBigInteger('airport_id');
            $table->foreign('airport_id')
            ->references('id')
            ->on('airports');

            $table->unsignedBigInteger('traveler_id');
            $table->foreign('traveler_id')
            ->references('id')
            ->on('traveler_types');

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
        Schema::dropIfExists('airport_and_taxes');
    }
}
