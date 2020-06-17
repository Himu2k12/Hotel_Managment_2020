<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalaryInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('salary_infos', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('staff_id');
            $table->string('month_of_salary');
            $table->date('salary_date');
            $table->integer('basic_salary')->nullable();
            $table->integer('allowances')->nullable();
            $table->integer('professional_tax')->nullable();
            $table->integer('Perquisites')->nullable();
            $table->double('over_time')->nullable();
            $table->integer('per_hour_cost')->nullable();
            $table->double('over_time_total')->nullable();
            $table->integer('total_salary');
            $table->text('description')->nullable();
            $table->unsignedInteger('assigned_by');
            $table->tinyInteger('status')->default(1);
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
        Schema::dropIfExists('salary_infos');
    }
}
