<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->boolean('is_auth');
            $table->string('title');
            $table->integer('price');
            $table->integer('category_id');
            $table->integer('brand_id');
            $table->text('description');


            $table->string('preview_image');

            $table->longText('char_title')->nullable();
            $table->longText('char_value')->nullable();

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
        Schema::dropIfExists('products');
    }
}
