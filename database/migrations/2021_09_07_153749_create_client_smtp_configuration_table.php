<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientSmtpConfigurationTable extends Migration
{
    /**
     * @return void
     */
    public function up()
    {
        Schema::create('client_smtp_configuration', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('client_id')->index();
            $table->string('host');
            $table->integer('port');
            $table->string('username');
            $table->string('password');
            $table->string('encryption')->nullable();
            $table->string('from_address')->nullable();
            $table->string('from_name')->nullable();
            $table->timestamps();
        });
    }

    /**
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('smtp_configuration');
    }
}
