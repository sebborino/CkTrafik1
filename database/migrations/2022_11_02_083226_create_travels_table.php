<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTravelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('travels', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('destination_id');
            $table->foreign('destination_id')
            ->references('id')
            ->on('destinations')
            ->onDelete('cascade');
            $table->dateTimeTz('open_until');

            $table->unsignedBigInteger('aircraft_id');
            $table->foreign('aircraft_id')
            ->references('id')
            ->on('aircrafts')
            ->onDelete('cascade');
            
            $table->unsignedBigInteger('seat_id')->nullable();
            $table->foreign('seats_id')
            ->references('id')
            ->on('seats')
            ->onDelete('cascade');

            $table->date('departure_date');
            $table->time('departure_time');
            $table->time('duration');
            $table->date('arrival_date');
            $table->time('arrival_time');
            $table->foreignId('stopover_id')->constrained('airports')->nullable();  
            $table->time('stopover_departure_datetime')->nullable();
            $table->time('stopover_arrival_datetime')->nullable();              
            $table->timestamp('cancelled_at')->nullable();

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
        Schema::dropIfExists('travels');
    }
}
