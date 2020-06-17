<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCancelBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cancel_bookings', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('booking_id');
            $table->unsignedInteger('room_id');
            $table->unsignedBigInteger('customer_id');
            $table->dateTime('check_in');
            $table->dateTime('check_out');
            $table->integer('adults');
            $table->integer('children')->nullable();
            $table->integer('booking_days');
            $table->integer('basic_rent');
            $table->integer('discount');
            $table->integer('total_rent');
            $table->tinyInteger('payment_status');//0=pending,1=done
            $table->integer('refund_amount')->nullable();//0=pending,1=done
            $table->tinyInteger('status')->default(5);//1= active, 2=done, 3=housekeeping done after booking, 4=advance booking canceled
            $table->unsignedInteger('created_by');//value=employee ID, who create the booking
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
        Schema::dropIfExists('cancel_bookings');
    }
}
