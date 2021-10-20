<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeeCertificatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee_certificates', function (Blueprint $table) {
            $table->id();
            $table->string('number');
            $table->unsignedBigInteger('test_id')->index();
            $table->unsignedBigInteger('certificate_pattern_id')->index();
            $table->unsignedBigInteger('employee_id')->index();
            $table->unsignedBigInteger('client_id')->index();
            $table->string('client_name')->nullable();
            $table->string('client_address')->nullable();
            $table->string('client_nip')->nullable();
            $table->string('employee_first_name')->nullable();
            $table->string('employee_last_name')->nullable();
            $table->string('employee_position')->nullable();
            $table->dateTime('test_date');
            $table->dateTime('release_date');
            $table->string('test_name')->nullable();
            $table->text('test_description')->nullable();
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
        Schema::dropIfExists('employee_certificates');
    }
}
