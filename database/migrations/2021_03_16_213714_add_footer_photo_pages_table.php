<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFooterPhotoPagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pages', function (Blueprint $table) {
            $table->string('footer_image')->after('image')->nullable();
        });

        DB::raw("UPDATE pages SET footer_image='/web/bh/assets/images/derma-men.webp' where id = 7");
        DB::raw("UPDATE pages SET footer_image='/web/bh/assets/images/dental.webp' where id = 8");
        DB::raw("UPDATE pages SET footer_image='/web/bh/assets/images/derma-women.webp' where id = 9");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
