<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('investors', function (Blueprint $table) {
            $table->dropForeign('investors_sector_id_foreign');
            $table->dropColumn('sector_id');
            $table->dropForeign('investors_sub_sector_id_foreign');
            $table->dropColumn('sub_sector_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('investors', function (Blueprint $table) {
            $table->unsignedBigInteger('sector_id')->nullable();
            $table->foreign('sector_id')->references('id')->on('sectors');
            $table->unsignedBigInteger('sub_sector_id')->nullable();
            $table->foreign('sub_sector_id')->references('id')->on('sectors');
        });
    }
};
