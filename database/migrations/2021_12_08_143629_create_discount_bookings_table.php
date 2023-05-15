<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Constants\BookingStatuses;
class CreateDiscountBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('discount_bookings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('discount_id')->references('id')->on('discounts')->onDelete('cascade');
            $table->foreignId('branche_id')->references('id')->on('branches')->onDelete('cascade');
            $table->foreignId('doctor_id')->references('id')->on('doctors')->onDelete('cascade');
            $table->string('name');
            $table->string('phone');
            $table->string('email');
            $table->dateTime('attendance_date');
            $table->text('notes')->nullable();
            $table->string('source')->nullable();
            $table->tinyInteger('sent')->default(0);
            $table->tinyInteger('period')->default(0);
            $table->tinyInteger('status')->default(BookingStatuses::PENDING);
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
        Schema::dropIfExists('discount_bookings');
    }
}
