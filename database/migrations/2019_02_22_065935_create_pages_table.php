<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('pages', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name_ru');
            $table->string('name_am');
            $table->string('name_en');
            $table->longText('description_ru');
            $table->longText('description_am');
            $table->longtext('description_en');

        });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pages');
    }
}
