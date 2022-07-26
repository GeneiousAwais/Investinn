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
        Schema::create('project_documents', function (Blueprint $table) {
            $table->id();
            $table->string('business_case')->nullable();
            $table->string('slide_deck')->nullable();
            $table->string('financial_documents')->nullable();
            $table->unsignedBigInteger('project_id')->nullable();
            $table->foreign('project_id')->references('id')->on('projects');     
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
        Schema::dropIfExists('project_documents');
    }
};
