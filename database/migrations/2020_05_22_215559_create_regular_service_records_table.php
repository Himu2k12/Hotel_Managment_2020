<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRegularServiceRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('regular_service_records', function (Blueprint $table) {
            $table->id();
            $table->string('service_area');
            $table->string('room_no')->nullable();
            $table->unsignedInteger('staff_id');
            $table->time('allocation_time');
            $table->time('finishing_time')->nullable();
            $table->text('staff_comment')->nullable();
            $table->unsignedInteger('allocated_by');
            $table->tinyInteger('status')->default(1); //value 1 is for assigning a work to a staff & value 2 is for completing that work by a staff
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
        Schema::dropIfExists('regular_service_records');
    }
}
