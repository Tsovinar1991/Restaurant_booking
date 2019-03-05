<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRestaurantMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('restaurant_menus', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name_en');
            $table->string('name_ru');
            $table->string('name_am');
            $table->longText('description_en');
            $table->longText('description_ru');
            $table->longText('description_am');
            $table->string('avatar');
            $table->integer('parent_id')->default(0)->nullable();
            $table->integer('restaurant_id')->unsigned()->nullable();
            $table->integer('price');
            $table->string('weight');
            $table->integer('status')->default(1);//if exist
            $table->timestamps();

            $table->foreign('restaurant_id')->references('id')->on('restaurants')->onDelete('set null');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('restaurant_menus');
    }
}
