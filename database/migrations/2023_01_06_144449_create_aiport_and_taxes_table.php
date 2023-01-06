<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAiportAndTaxesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('aiport_and_taxes', function (Blueprint $table) {
            $table->id();
            $table->decimal('airport_tax',14,2);
            $table->char('airport_tax_code',3);

            $table->unsignedBigInteger('airport_id');
            $table->foreign('airport_id')
            ->references('id')
            ->on('airports');

            $table->unsignedBigInteger('traveler_id');
            $table->foreign('traveler_id')
            ->references('id')
            ->on('traveler_types');

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
        Schema::dropIfExists('aiport_and_taxes');
    }
}
