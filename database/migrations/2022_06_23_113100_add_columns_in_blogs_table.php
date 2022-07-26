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
        Schema::table('blogs', function (Blueprint $table) {
            $table->integer('published_by')->after('title')->nullable();
            $table->string('meta_tags')->after('published_by')->nullable();
            $table->text('meta_description')->after('meta_tags')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('blogs', function (Blueprint $table) {
            $table->dropColumn('published_by');
            $table->dropColumn('meta_tags');
            $table->dropColumn('meta_description');
        });
    }
};
