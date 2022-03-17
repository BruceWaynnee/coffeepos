<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('order_number')->unique()->nullable();
            $table->integer('receipt_number')->default(0);
            $table->unsignedBigInteger('customer_id')->nullable();
            $table->decimal('grand_total',8,2);
            $table->decimal('payment_receive',8,2);
            $table->decimal('payment_return',8,2);
            $table->string('payment_option');
            $table->string('cashier')->default('satya');
            $table->unsignedBigInteger('income_archive_id')->nullable();

            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('set null');
            $table->foreign('income_archive_id')->references('id')->on('income_archives')->onDelete('set null');
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
        Schema::dropIfExists('orders');
    }
}
