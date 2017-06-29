<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateCanvasPostAddStatusApproval extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table(CanvasHelper::TABLES['posts'], function ($table) {
            $table->boolean('is_approved')->after('is_published')->default(false);
            $table->integer('approved_by')->after('is_approved')->nullable();
            $table->timestamp('approved_at')->nullable()->after('approved_by')->index();
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
            $table->dropColumn('is_approved');
            $table->dropColumn('approved_at');
            $table->dropColumn('approved_by');
        });
    }
}
