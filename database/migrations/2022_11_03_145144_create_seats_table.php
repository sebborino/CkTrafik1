<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSeatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('seats', function (Blueprint $table) {
            $table->id();
            $table->integer('seats_total');
            $table->foreignId('travel_id')->constrained('travels');  
            $table->integer('seats_remaning')->default(0);
            $table->integer('seats_occupied')->default(0);
            $table->integer('add_seats')->default(0);
            $table->integer('close_seats')->default(0);
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
        Schema::dropIfExists('seats');
    }
}
