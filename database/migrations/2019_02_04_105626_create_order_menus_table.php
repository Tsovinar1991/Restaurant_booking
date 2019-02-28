<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_menus', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('order_info_id')->unsigned();
            $table->integer('menu_id')->unsigned()->nullable();
            $table->integer('count');
            $table->integer('total');
            $table->timestamps();

            $table->foreign('order_info_id')->references('id')->on('order_infos');
            $table->foreign('menu_id')->references('id')->on('restaurant_menus')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_menus');
    }
}
