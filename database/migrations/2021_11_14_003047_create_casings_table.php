<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCasingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('casings', function (Blueprint $table) {
            $table->id();
            $table->string('image_before');
            $table->string('image_after');
            $table->boolean('status')->default(\App\Constants\Statuses::ACTIVE);
            $table->foreignId('category_id')->nullable()->references('id')->on('casing_categories')->onDelete('cascade');
            $table->foreignId('doctor_id')->nullable()->references('id')->on('doctors')->onDelete('cascade');
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
        Schema::dropIfExists('casings');
    }
}
