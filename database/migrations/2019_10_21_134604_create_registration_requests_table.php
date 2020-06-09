<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRegistrationRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('registration_requests', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('company_name');
            $table->string('bank');
            $table->string('address');
            $table->string('tin');
            $table->string('ctea');
            $table->string('mfi');
            $table->integer('user_id')->unsigned();
            $table->timestamps();
        });

        Schema::table('users', function (Blueprint $table) {
            $table->boolean('confirmed')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('registration_requests');
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('confirmed');
        });
    }
}
