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
        Schema::create('company_entrepreneurs', function (Blueprint $table) {
            $table->id();
            $table->string('company_name')->nullable();
            $table->string('website_link')->nullable();
            $table->string('contact_person')->nullable();
            $table->string('email')->nullable();
            $table->string('phone_no')->nullable();
            $table->string('designation')->nullable();
            $table->string('logo')->nullable();
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
        Schema::dropIfExists('company_entrepreneurs');
    }
};
