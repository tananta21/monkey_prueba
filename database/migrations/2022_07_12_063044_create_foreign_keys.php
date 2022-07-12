<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateForeignKeys extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Schema::table('vehicles', function (Blueprint $table) {           
        //     $table->foreign('brand_id')->references('id')->on('brands')->onDelete("cascade");
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Schema::dropIfExists('foreign_keys');

        // Schema::table('vehicles', function (Blueprint $table) {
        //     $table->dropForeign('vehicles_brand_id_foreign');
        // });
    }
}
