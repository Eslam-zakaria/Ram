<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDiscountTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('discount_translations', function (Blueprint $table) {
            $table->id();
            $table->string('locale')->index();

            $table->unsignedBigInteger('discount_id');
            $table->unique(['discount_id', 'locale']);
            $table->foreign('discount_id')->references('id')->on('discounts')->onDelete('cascade');

            $table->string('name');
            $table->text('description')->nullable();

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
        Schema::table('discount_translations', function (Blueprint $table) {
            $table->dropForeign(['discount_id']);
        });

        Schema::dropIfExists('discount_translations');
    }
}
