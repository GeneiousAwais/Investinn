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
        Schema::table('investors', function (Blueprint $table) {
            $table->string('investment_on_behalf')->after('investment_range_id')->nullable();
            $table->string('reason_to_join_c_hub')->after('investment_on_behalf')->nullable();
            $table->string('venture_backed_experience')->after('reason_to_join_c_hub')->nullable();
            $table->string('interested')->after('venture_backed_experience')->nullable();
            $table->string('terms_and_condition')->after('interested')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('investors', function (Blueprint $table) {
            $table->dropColumn('investment_on_behalf');
            $table->dropColumn('reason_to_join_c_hub');
            $table->dropColumn('venture_backed_experience');
            $table->dropColumn('interested');
            $table->dropColumn('terms_and_condition');
        });
    }
};
