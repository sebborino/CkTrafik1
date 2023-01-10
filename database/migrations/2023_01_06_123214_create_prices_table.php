<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePricesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prices', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('class_code')->nullable();
            $table->decimal('tax_price',8,2)->nullable();
            $table->char('tax_code',3)->nullable();

            // All Amount and code end here
            // All relations start here
            $table->unsignedBigInteger('price_category_id');
            $table->foreign('price_category_id')
            ->references('id')
            ->on('price_categories');

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

            $table->unsignedBigInteger('return_id')->nullable();
            $table->foreign('return_id')
            ->references('id')
            ->on('destinations');

            $table->unsignedBigInteger('class_type_id');
            $table->foreign('class_type_id')
            ->references('id')
            ->on('class_types');

            // Rules And details start here

            $table->integer('use_in')->nullable();
            $table->boolean('refundable');
            $table->boolean('change_able');
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
        Schema::dropIfExists('prices');
    }
}
