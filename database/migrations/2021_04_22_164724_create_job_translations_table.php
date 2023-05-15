<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('job_translations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('locale')->index();

            // Foreign key to the main model
            $table->unsignedBigInteger('job_id');
            $table->unique(['job_id', 'locale']);
            $table->foreign('job_id')->references('id')->on('jobs')->onDelete('cascade');

            $table->string('name');
            $table->text('content')->nullable();
            $table->text('description')->nullable();
            $table->text('requirements')->nullable();

            $table->timestamps();
        });

        Schema::table('jobs', function (Blueprint $table) {
            $table->dropColumn('name');
            $table->dropColumn('content');
        });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('job_translations', function (Blueprint $table) {
            $table->dropForeign(['job_id']);
        });

        Schema::dropIfExists('job_translations');
    }
}
