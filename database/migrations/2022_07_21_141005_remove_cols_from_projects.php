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
        Schema::table('projects', function (Blueprint $table) {
            $table->dropForeign('projects_partnership_type_id_foreign');
            $table->dropColumn('partnership_type_id');            
            $table->dropColumn('estimated_project_irr');
            $table->dropColumn('return_on_investment');
            $table->dropColumn('business_case');
            $table->dropColumn('slide_deck');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->string('business_case')->nullable();
            $table->string('slide_deck')->nullable();
            $table->unsignedBigInteger('partnership_type_id')->nullable();
            $table->foreign('partnership_type_id')->references('id')->on('partnership_types');
            $table->integer('estimated_project_irr')->nullable();
            $table->integer('return_on_investment')->after('estimated_project_irr')->nullable();

        });
    }
};
