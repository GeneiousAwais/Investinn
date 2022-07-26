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
        Schema::table('users', function (Blueprint $table) {
            $table->unsignedBigInteger('user_type_id')->after('password')->nullable();;
            $table->foreign('user_type_id')->references('id')->on('user_types');
            $table->integer('is_approved')->after('user_type_id')->nullable();
            $table->integer('approved_by')->after('is_approved')->nullable();
            $table->integer('is_active')->after('approved_by')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign('users_user_type_id_foreign');
            $table->dropColumn('user_type_id');
            $table->dropColumn('is_approved');
            $table->dropColumn('approved_by');
            $table->dropColumn('is_active');
        });
    }
};
