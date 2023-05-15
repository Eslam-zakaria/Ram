<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDoctorTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('doctor_translations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('locale')->index();

            // Foreign key to the main model
            $table->unsignedBigInteger('doctor_id');
            $table->unique(['doctor_id', 'locale']);
            $table->foreign('doctor_id')->references('id')->on('doctors')->onDelete('cascade');

            $table->string('name');
            $table->text('description')->nullable();
            $table->text('bio')->nullable();

            $table->timestamps();
        });


        Schema::table('doctors', function (Blueprint $table) {
            $table->dropColumn('name');
            $table->dropColumn('bio');
            $table->dropColumn('description');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('doctor_translations', function (Blueprint $table) {
            $table->dropForeign(['doctor_id']);
        });

        Schema::dropIfExists('doctor_translations');
    }
}
