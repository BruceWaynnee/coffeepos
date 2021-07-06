<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIncomeArchivesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('income_archives', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamp('start_date');
            $table->timestamp('end_date')->nullable();
            $table->string('staff')->nullable();
            $table->integer('total_order_made')->nullable();
            $table->integer('total_revenue')->nullable();
            $table->integer('total_net_income')->nullable();
            $table->integer('total_expense')->nullable();
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
        Schema::dropIfExists('income_archives');
    }
}
