<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIncidentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('incidents', function (Blueprint $table) {
            $table->id();
            $table->string('number');
            $table->dateTime('date_application');
            $table->dateTime('date_receipt_company')->nullable();
            $table->dateTime('date_writing')->nullable();
            $table->unsignedInteger('user_id');
            $table->string('type_author');
            $table->string('author_name')->nullable();
            $table->string('title');
            $table->longText('content')->nullable();
            $table->unsignedInteger('type_id')->index();
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
        Schema::dropIfExists('incidents');
    }
}
