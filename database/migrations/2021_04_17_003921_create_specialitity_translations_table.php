<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSpecialitityTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('specificity_translations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('locale')->index();

            // Foreign key to the main model
            $table->unsignedBigInteger('specificity_id');
            $table->unique(['specificity_id', 'locale']);
            $table->foreign('specificity_id')->references('id')->on('specificities')->onDelete('cascade');

            $table->string('name');
            $table->text('description')->nullable();
            $table->text('brief')->nullable();

            $table->timestamps();
        });


        Schema::table('specificities', function (Blueprint $table) {
            $table->dropColumn('name');
            $table->dropColumn('description');
            $table->dropColumn('brief');
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
            $table->dropForeign(['specificity_id']);
        });

        Schema::dropIfExists('specificity_translations');
    }
}
