<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCardTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('card_translations', function (Blueprint $table) {
            $table->id();
            $table->string('locale')->index();

            $table->unsignedBigInteger('card_id');
            $table->unique(['card_id', 'locale']);
            $table->foreign('card_id')->references('id')->on('cards')->onDelete('cascade');

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
        Schema::table('card_translations', function (Blueprint $table) {
            $table->dropForeign(['card_id']);
        });

        Schema::dropIfExists('card_translations');
    }
}
