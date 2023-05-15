<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOfferBrancheTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('offer_branche_translations', function (Blueprint $table) {
            $table->id();
            $table->string('locale')->index();

            // Foreign key to the main model
            $table->unsignedBigInteger('offer_branche_id');
            $table->unique(['offer_branche_id', 'locale']);
            $table->foreign('offer_branche_id')->references('id')->on('offer_branches')->onDelete('cascade');

            $table->string('name');
            $table->string('slug'); 
            $table->string('desc_offer')->nullable();
            $table->string('currency');
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
        Schema::table('offer_branche_translations', function (Blueprint $table) {
            $table->dropForeign(['offer_branche_id']);
        });
        Schema::dropIfExists('offer_branche_translations');
    }
}
