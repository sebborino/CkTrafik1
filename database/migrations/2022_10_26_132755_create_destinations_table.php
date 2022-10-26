<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDestinationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('destinations', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->foreignId('from_id')->constrained('airports');  
            $table->foreignId('to_id')->constrained('airports');
            
            $table->unsignedBigInteger('flight_id');
            $table->foreign('flight_id')
            ->references('id')
            ->on('flights')
            ->onDelete('cascade');

            $table->softDeletes('cancelled_at');    
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
        Schema::dropIfExists('destinations');
    }
}
