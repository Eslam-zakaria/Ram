<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOfferTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('offer_translations', function (Blueprint $table) {
            $table->id();
            $table->string('locale')->index();

            // Foreign key to the main model
            $table->unsignedBigInteger('offer_id');
            $table->unique(['offer_id', 'locale']);
            $table->foreign('offer_id')->references('id')->on('offers')->onDelete('cascade');

            $table->string('name');
            $table->text('description')->nullable();
            $table->timestamps();
        });
        Schema::table('offers', function (Blueprint $table) {
            $table->dropForeign('offers_page_id_foreign');
            $table->dropColumn('page_id');
            $table->dropColumn('name');
            $table->dropColumn('description');
            $table->foreignId('branche_id')->after('image')->references('id')->on('offer_branches')->onDelete('cascade');
            $table->foreignId('service_id')->after('image')->references('id')->on('services')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('offer_translations', function (Blueprint $table) {
            $table->dropForeign(['offer_id']);
        });
        Schema::dropIfExists('offer_translations');
    }
}
