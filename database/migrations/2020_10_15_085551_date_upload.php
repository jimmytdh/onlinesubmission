<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DateUpload extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('bids', function (Blueprint $table) {
            $table->dateTime('date_financial')->after('financial_file')->nullable();
            $table->dateTime('date_technical')->after('technical_file')->nullable();
            $table->dateTime('date_mfinancial')->after('mfinancial_file')->nullable();
            $table->dateTime('date_mtechnical')->after('mtechnical_file')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('bids', function (Blueprint $table) {
            //
        });
    }
}
