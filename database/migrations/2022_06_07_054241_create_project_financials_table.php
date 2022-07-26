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
        Schema::create('project_financials', function (Blueprint $table) {
            $table->id();
            $table->string('paid_up_capital')->nullable();
            $table->string('previously_raised')->nullable();
            $table->string('current_target_to_raise')->nullable();
            $table->string('raised_so_far')->nullable();
            $table->string('minimum_investment')->nullable();
            $table->unsignedBigInteger('deal_type_id')->nullable();
            $table->foreign('deal_type_id')->references('id')->on('deal_types');
            $table->string('deal_offer')->nullable();
            $table->string('financials')->nullable();
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
        Schema::dropIfExists('project_financials');
    }
};
