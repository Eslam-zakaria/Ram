<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Modules\Lead\Constants\InstallmentCompany;
class AddForginkeyLeadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('leads', function (Blueprint $table) {
            $table->foreignId('doctor_id')->after('branche_id')->references('id')->on('doctors')->onDelete('cascade');
            $table->foreignId('speciality')->after('branche_id')->references('id')->on('specificities')->onDelete('cascade');
            $table->integer('company')->after('offer_id')->default(InstallmentCompany::TAMWEEL);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('leads', function (Blueprint $table) {
            //
        });
    }
}
