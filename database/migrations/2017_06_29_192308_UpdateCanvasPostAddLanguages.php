<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateCanvasPostAddLanguages extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table(CanvasHelper::TABLES['posts'], function ($table) {
            $table->string('language')->default('en');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table(CanvasHelper::TABLES['posts'], function ($table) {
            $table->dropColumn('language');
        });
    }
}
