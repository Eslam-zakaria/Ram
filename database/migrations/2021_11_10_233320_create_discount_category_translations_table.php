<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDiscountCategoryTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('discount_category_translations', function (Blueprint $table) {
            $table->id();
            $table->string('locale')->index();

            // Foreign key to the main model
            $table->unsignedBigInteger('discount_category_id');
            $table->unique(['discount_category_id', 'locale'], 'discount_category_id_locale_unique');
            $table->foreign('discount_category_id')->references('id')->on('discount_categories')->onDelete('cascade');

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
        Schema::table('discount_category_translations', function (Blueprint $table) {
            $table->dropForeign(['discount_category_id']);
        });

        Schema::dropIfExists('discount_category_translations');
    }
}
