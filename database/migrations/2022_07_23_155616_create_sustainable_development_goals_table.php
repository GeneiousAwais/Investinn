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
        Schema::create('sustainable_development_goals', function (Blueprint $table) {
            $table->id();
            $table->string('sdg_name')->nullable();
            $table->integer('is_active')->nullable()->default(0);
            $table->string('icon_name')->nullable();
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
        Schema::dropIfExists('sustainable_development_goals');
    }
};
