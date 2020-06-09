<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductColorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_colors', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('colorHEX');
            $table->integer('product_id')->unsigned();
            $table->timestamps();
        });

        Schema::table('product_images', function (Blueprint $table) {
            $table->dropColumn('product_id');
            $table->integer('product_color_id')->unsigned();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_colors');
        Schema::table('product_images', function (Blueprint $table) {
            $table->dropColumn('product_color_id');
            $table->integer('product_id')->unsigned();
        });
    }
}
