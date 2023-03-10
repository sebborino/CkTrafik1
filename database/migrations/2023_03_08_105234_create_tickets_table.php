<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->char('e_ticket')->nullable();
            $table->string('pnr')->nullable();
            $table->decimal('fare_price',14,2);
            $table->decimal('tax',14,2);
            $table->decimal('rate',14,2);
            $table->foreignId('booking_id');
            $table->foreignId('currency_id');
            $table->string('gender_code');
            $table->string('first_name');
            $table->string('last_name');
            $table->date('birthday');
            $table->string('nation');
            $table->string('passport_number');
            $table->string('expiry');
            $table->string('passport_nation');
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
        Schema::dropIfExists('tickets');
    }
}
