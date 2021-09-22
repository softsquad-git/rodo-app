<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConclusionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('conclusions', function (Blueprint $table) {
            $table->id();
            $table->string('number');
            $table->dateTime('date_application');
            $table->string('name');
            $table->string('title');
            $table->unsignedInteger('type_id')->index();
            $table->unsignedInteger('status_id')->index();
            $table->text('content');
            $table->unsignedInteger('accepted_employee_id')->index()->nullable();
            $table->boolean('is_accepted')->default(0);
            $table->dateTime('accepted_date')->nullable();
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
        Schema::dropIfExists('conclusions');
    }
}
