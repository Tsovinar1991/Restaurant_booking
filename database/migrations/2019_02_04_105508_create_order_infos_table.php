<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_infos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('telephone');
            $table->string('address');
            $table->integer('total');
            $table->integer('payment_type')->default(0)->nullable();
            $table->integer('payment_status')->default(0)->nullable();
            //$table->string('status')->default('new')->nullable();
            $table->enum('status', ['new', 'confirmed', 'in progress', 'canceled'])->default('new')->nullable();
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
        Schema::dropIfExists('order_infos');
    }
}
