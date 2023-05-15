<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePageBranchesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
//        Schema::create('page_branches', function (Blueprint $table) {
//            $table->foreignId('page_id')->references('id')->on('pages')->onDelete('cascade');
//            $table->foreignId('branche_id')->references('id')->on('branches')->onDelete('cascade');
//        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
//        Schema::dropIfExists('page_branches');
    }
}
