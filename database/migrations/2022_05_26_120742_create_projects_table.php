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
        Schema::create('projects', function (Blueprint $table) {

            // Project Summary fields

            $table->id();
            $table->string('project_status')->nullable();
            $table->string('project_title')->nullable();

            $table->unsignedBigInteger('sector_id')->nullable();
            $table->foreign('sector_id')->references('id')->on('sectors');

            $table->unsignedBigInteger('sub_sector_id')->nullable();
            $table->foreign('sub_sector_id')->references('id')->on('sectors');

            $table->string('project_location')->nullable();

            $table->unsignedBigInteger('project_stage_id')->nullable();
            $table->foreign('project_stage_id')->references('id')->on('project_stages');

            $table->unsignedBigInteger('partnership_type_id')->nullable();
            $table->foreign('partnership_type_id')->references('id')->on('partnership_types');

            $table->date('tentative_start_date')->nullable();
            $table->integer('tentative_duration')->nullable();

            $table->integer('estimated_project_irr')->nullable();
            $table->integer('estimated_economic_irr')->nullable();
            $table->string('project_scale')->nullable();
            $table->string('project_endorsement')->nullable();

            $table->string('project_rating')->nullable();
            $table->integer('project_views')->nullable();

            $table->unsignedBigInteger('project_coordinator')->nullable();
            $table->foreign('project_coordinator')->references('id')->on('users');


            // Project Details fields

            $table->string('executive_summary')->nullable();
            $table->string('problem')->nullable();
            $table->string('market')->nullable();
            $table->string('about_competition')->nullable();
            $table->string('revenue_model')->nullable();
            $table->string('distribution_channel')->nullable();
            $table->string('marketing_plan')->nullable();
            $table->string('risk_challenge')->nullable();
            $table->string('project_tags')->nullable();
            $table->string('business_case')->nullable();
            $table->string('slide_deck')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('projects');
    }
};
