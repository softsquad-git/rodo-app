<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGusInformationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gus_information', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('resource_id')->index();
            $table->string('resource_type');
            $table->string('name');
            $table->string('nip');
            $table->string('regon');
            $table->string('krs')->nullable();
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
        Schema::dropIfExists('gus_information');
    }
}
