<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('mobile_no');
            $table->string('full_name');
            $table->string('occupation');
            $table->string('purpose_of_visit')->nullable();
            $table->unsignedBigInteger('national_id')->nullable();
            $table->string('passport_no')->nullable();
            $table->text('address');
            $table->string('city');
            $table->string('country');
            $table->string('email_address')->nullable();
            $table->string('mobile_two')->nullable();
            $table->unsignedInteger('created_by');
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
        Schema::dropIfExists('customers');
    }
}
