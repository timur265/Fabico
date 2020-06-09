<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SimpleRegistration extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('registration_requests', function (Blueprint $table) {
            $table->dropColumn('bank');
            $table->dropColumn('address');
            $table->dropColumn('tin');
            $table->dropColumn('ctea');
            $table->dropColumn('mfi');
            $table->string('city');
            $table->string('email');
        });

        Schema::table('orders', function (Blueprint $table) {
            $table->string('company_name')->nullable()->change();
            $table->string('bank')->nullable()->change();
            $table->string('address')->nullable()->change();
            $table->string('tin')->nullable()->change();
            $table->string('ctea')->nullable()->change();
            $table->string('mfi')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('registration_requests', function (Blueprint $table) {
            $table->string('bank');
            $table->string('address');
            $table->string('tin');
            $table->string('ctea');
            $table->string('mfi');
            $table->dropColumn('city');
            $table->dropColumn('email');
        });
    }
}
