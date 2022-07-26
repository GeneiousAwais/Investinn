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
        Schema::create('project_investors', function (Blueprint $table) {
           $table->id();
           $table->unsignedBigInteger('project_investor')->nullable();
           $table->foreign('project_investor')->references('id')->on('users');
           $table->unsignedBigInteger('project_id')->nullable();
           $table->foreign('project_id')->references('id')->on('projects');     
           $table->integer('invest_amount')->nullable();
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
        Schema::dropIfExists('project_investors');
    }
};
