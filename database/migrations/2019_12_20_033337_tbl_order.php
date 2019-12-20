<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TblOrder extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_order', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('customer_id');
            $table->unsignedInteger('shipping_id');
            $table->unsignedInteger('payment_id');
            $table->string('order_total');
            $table->string('order_status');
            $table->foreign('customer_id')->references('customer_id')->on('tbl_customer')->onDelete('cascade');
            $table->foreign('shipping_id')->references('shipping_id')->on('tbl_shipping')->onDelete('cascade');
            $table->foreign('payment_id')->references('id')->on('tbl_payment')->onDelete('cascade');
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
        Schema::dropIfExists('tbl_order');
    }
}
