<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCeoFildesToSpecificityTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('specificity_translations', function (Blueprint $table) {
            $table->string('alt_image')->nullable();
            $table->string('alt_brief_image')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('specificity_translations', function (Blueprint $table) {
            //
        });
    }
}
