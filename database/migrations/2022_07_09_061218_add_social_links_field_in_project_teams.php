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
        Schema::table('project_teams', function (Blueprint $table) {
            $table->string('facebook')->after('team_bio')->nullable();
            $table->string('twitter')->after('facebook')->nullable();
            $table->string('linkedin')->after('twitter')->nullable();
            $table->string('instagram')->after('linkedin')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('project_teams', function (Blueprint $table) {
            $table->dropColumn('facebook');
            $table->dropColumn('twitter');
            $table->dropColumn('linkedin');
            $table->dropColumn('instagram');
        });
    }
};
