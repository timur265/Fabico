<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ResizedProductImages extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->string('preview_image_catalog')->nullable();
        });

        Schema::table('product_images', function (Blueprint $table) {
            $table->string('img_catalog')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn('preview_image_catalog');
        });

        Schema::table('product_images', function (Blueprint $table) {
            $table->dropColumn('img_catalog');
        });
    }
}
