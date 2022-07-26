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
        Schema::table('projects', function (Blueprint $table) {
             
            $table->dropForeign('projects_project_location_id_foreign');
            $table->dropColumn('project_location_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->unsignedBigInteger('project_location_id')->after('sub_sector_id')->nullable();
            $table->foreign('project_location_id')->references('id')->on('cities');
        });
    }
};
