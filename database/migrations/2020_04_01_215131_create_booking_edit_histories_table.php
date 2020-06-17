<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookingEditHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('booking_edit_histories', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('booking_id');
            $table->date('check_out');
            $table->integer('total_rent');
            $table->integer('partial_payment');
            $table->unsignedInteger('created_by');//who did the change in booking
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
        Schema::dropIfExists('booking_edit_histories');
    }
}
