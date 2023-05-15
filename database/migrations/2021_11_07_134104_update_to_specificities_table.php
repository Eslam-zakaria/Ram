<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateToSpecificitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('specificities', function (Blueprint $table) {
            $table->string('image');
            $table->unsignedBigInteger('service_id')->after('id');
            $table->foreign('service_id')->references('id')->on('services')->onDelete('cascade'); 
        });

        Schema::table('specificity_translations', function (Blueprint $table) {
            $table->text('brief')->nullable()->change();
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

    }
}
