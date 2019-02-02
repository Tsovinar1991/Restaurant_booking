<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Restaurant;

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
            $table->increments('id');
            $table->integer('restaurant_id')->unsigned();;
            $table->integer('seat_id')->unsigned();;
            $table->integer('guest_count');
            $table->dateTime("start");
            $table->dateTime("end");
            $table->string('message');
            $table->string('name');
            $table->string('telephone');
            $table->integer('status')->default(0);
            $table->timestamps();
            $table->foreign('restaurant_id')->references('id')->on('restaurants');
            $table->foreign('seat_id')->references('id')->on('seats');

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
