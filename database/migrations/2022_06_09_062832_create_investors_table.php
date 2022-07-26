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
        Schema::create('investors', function (Blueprint $table) {
            $table->id();
            $table->string('about_me')->nullable();
            $table->unsignedBigInteger('expertise_id')->nullable();
            $table->foreign('expertise_id')->references('id')->on('expertises');
            $table->unsignedBigInteger('country_id')->nullable();
            $table->foreign('country_id')->references('id')->on('countries');
            $table->unsignedBigInteger('sector_id')->nullable();
            $table->foreign('sector_id')->references('id')->on('sectors');
            $table->unsignedBigInteger('sub_sector_id')->nullable();
            $table->foreign('sub_sector_id')->references('id')->on('sectors');
            $table->unsignedBigInteger('investment_range_id')->nullable();
            $table->foreign('investment_range_id')->references('id')->on('investment_ranges');
            $table->string('picture')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users');            
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
        Schema::dropIfExists('investors');
    }
};
