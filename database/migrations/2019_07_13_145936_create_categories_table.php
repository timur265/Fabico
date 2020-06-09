<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('ru_title');
            $table->string('en_title')->nullable();
            $table->string('uz_title')->nullable();
            $table->longText('ru_description')->nullable();
            $table->longText('en_description')->nullable();
            $table->longText('uz_description')->nullable();
            $table->string('image')->nullable();
            $table->string('slug');


            $table->nestedSet();
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
        Schema::dropIfExists('categories');
    }
}
