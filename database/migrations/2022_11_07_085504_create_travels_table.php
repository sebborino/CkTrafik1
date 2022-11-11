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

            $table->date('departure_date')->format('d-m-Y');
            $table->time('departure_time');
            $table->time('duration');
            $table->date('arrival_date')->format('d-m-Y');
            $table->time('arrival_time');
            $table->foreignId('stopover_id')->nullable()->constrained('airports');  
            $table->datetime('stopover_departure_datetime')->format('d-m-Y H:i')->nullable();
            $table->datetime('stopover_arrival_datetime')->format('d-m-Y H:i')->nullable();              
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
