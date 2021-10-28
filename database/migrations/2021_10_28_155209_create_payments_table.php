<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('order_id');
            $table->string('payment_method'); // pardakht az che tarighi bode
            $table->string('gateway')->nullable(); // pardakht az che dargahi bode
            $table->string('ref_num')->nullable();
            $table->integer('amount');
            $table->tinyInteger('status')->comment('0 : Incomplete , 1:complete');
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
        Schema::dropIfExists('payments');
    }
}
