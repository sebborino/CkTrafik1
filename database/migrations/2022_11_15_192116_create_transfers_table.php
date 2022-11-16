<?php

use App\Enums\BankTransferType;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransfersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transfers', function (Blueprint $table) {
            $table->id();
            $table->enum('bank_type', BankTransferType::getValues());
            $table->unsignedBigInteger('bank_id');
            $table->foreign('bank_id')
            ->references('id')
            ->on('banks');
            $table->decimal('balance_from',8,2)->default(0);
            $table->decimal('balance_to',8,2)->default(0);
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
        Schema::dropIfExists('transfers');
    }
}
