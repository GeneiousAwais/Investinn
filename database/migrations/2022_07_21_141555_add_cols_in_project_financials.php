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
        Schema::table('project_financials', function (Blueprint $table) {
            $table->dropColumn('financial_documents');
            $table->unsignedBigInteger('partnership_type_id')->nullable();
            $table->foreign('partnership_type_id')->references('id')->on('partnership_types');
            $table->integer('estimated_project_irr')->nullable();
            $table->integer('return_on_investment')->after('estimated_project_irr')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('project_financials', function (Blueprint $table) {
            $table->string('financial_documents')->nullable();
            $table->dropForeign('iprojects_partnership_type_id_foreign');
            $table->dropColumn('partnership_type_id');            
            $table->dropColumn('estimated_project_irr');
            $table->dropColumn('return_on_investment');
        });
    }
};
