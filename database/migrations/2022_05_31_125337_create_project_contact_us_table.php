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
        Schema::create('project_contact_us', function (Blueprint $table) {
            $table->id();
            $table->string('company_name')->nullable();
            $table->string('website_link')->nullable();
            $table->string('contact_person')->nullable();
            $table->string('email')->nullable();
            $table->string('phone_no')->nullable();
            $table->string('designation')->nullable();
            $table->string('logo')->nullable();
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
        Schema::dropIfExists('project_contact_us');
    }
};
