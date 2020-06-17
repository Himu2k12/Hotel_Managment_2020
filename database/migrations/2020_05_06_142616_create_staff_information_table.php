<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStaffInformationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('staff_information', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('user_id');
            $table->string('staff_photo');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('fathers_name');
            $table->string('mothers_name');
            $table->text('present_address');
            $table->text('permanent_address');
            $table->date('date_of_birth');
            $table->date('joining_date');
            $table->string('designation');
            $table->string('blood_group');
            $table->string('cv_doc');
            $table->text('description');
            $table->string('bank_account_no');
            $table->string('bank_name');
            $table->string('branch_name');
            $table->string('account_holder_name');
            $table->string('salary_amount');
            $table->string('status')->default(1);
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
        Schema::dropIfExists('staff_information');
    }
}
