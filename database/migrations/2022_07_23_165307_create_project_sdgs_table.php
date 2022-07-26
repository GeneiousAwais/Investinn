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
        Schema::create('project_sdgs', function (Blueprint $table) {
             $table->id();
            $table->unsignedBigInteger('sdg_id')->nullable();
            $table->foreign('sdg_id')->references('id')->on('sustainable_development_goals');
            $table->integer('commentable_id');
            $table->string("commentable_type");   
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
        Schema::dropIfExists('project_sdgs');
    }
};
