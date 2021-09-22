<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('user_id')->index();
            $table->string('number');
            $table->unsignedInteger('client_id')->index();
            $table->string('hr_id')->nullable();
            $table->string('it_id')->nullable();
            $table->string('position')->nullable();
            $table->unsignedInteger('role_id')->index();
            $table->unsignedInteger('type_contract_id')->index();
            $table->date('end_date_contract')->nullable();
            $table->boolean('is_contract_indefinite_period')->default(0);
            $table->text('comments')->nullable();
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
        Schema::dropIfExists('employees');
    }
}
