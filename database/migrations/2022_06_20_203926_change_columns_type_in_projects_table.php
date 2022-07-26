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
            $table->text('executive_summary')->change()->nullable();
            $table->text('problem')->change()->nullable();
            $table->text('market')->change()->nullable();
            $table->text('about_competition')->change()->nullable();
            $table->text('revenue_model')->change()->nullable();
            $table->text('distribution_channel')->change()->nullable();
            $table->text('marketing_plan')->change()->nullable();
            $table->text('risk_challenge')->change()->nullable();
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
            $table->string('executive_summary')->change()->nullable();
            $table->string('problem')->change()->nullable();
            $table->string('market')->change()->nullable();
            $table->string('about_competition')->change()->nullable();
            $table->string('revenue_model')->change()->nullable();
            $table->string('distribution_channel')->change()->nullable();
            $table->string('marketing_plan')->change()->nullable();
            $table->string('risk_challenge')->change()->nullable();
        });
    }
};
