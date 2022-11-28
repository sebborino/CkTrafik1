<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFaktureGenerateTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fakture_generate', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('e-ticket')->unique();
            $table->decimal('fare_price',8,2);
            $table->decimal('tax',8,2);
            $table->text('traveler_name');
            $table->string('pnr',6);
            $table->string('agent');
            $table->date('dato');
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
        Schema::dropIfExists('fakture_generate');
    }
}
