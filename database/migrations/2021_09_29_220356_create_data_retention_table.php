<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDataRetentionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data_retention', function (Blueprint $table) {
            $table->id();
            $table->string('number');
            $table->string('name');
            $table->integer('count');
            $table->integer('unit_day');
            $table->integer('unit_month');
            $table->integer('unit_year');
            $table->unsignedInteger('status_id')->index();
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
        Schema::dropIfExists('data_retention');
    }
}
