<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateCanvasPostAddFeaturedAndPin extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table(CanvasHelper::TABLES['posts'], function ($table) {
            $table->boolean('featured_on_index')->after('page_image')->default(true);
            $table->boolean('is_pinned')->after('is_published')->default(false);
            $table->timestamp('pinned_expiration_at')->nullable()->after('is_pinned');
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
            $table->dropColumn('featured_on_index');
            $table->dropColumn('is_pinned');
            $table->dropColumn('pinned_expiration_at');
        });
    }
}
