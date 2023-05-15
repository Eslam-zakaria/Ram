<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCasingCategoryTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('casing_category_translations', function (Blueprint $table) {
            $table->id();
            $table->string('locale')->index();

            // Foreign key to the main model
            $table->unsignedBigInteger('casing_category_id');
            $table->unique(['casing_category_id', 'locale']);
            $table->foreign('casing_category_id')->references('id')->on('casing_categories')->onDelete('cascade');

            $table->string('name');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('casing_category_translations', function (Blueprint $table) {
            $table->dropForeign(['casing_category_id']);
        });

        Schema::dropIfExists('casing_category_translations');
    }
}
