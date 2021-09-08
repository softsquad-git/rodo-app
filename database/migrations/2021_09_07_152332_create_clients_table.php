<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->string('auto_number');
            $table->string('short');
            $table->unsignedInteger('type_id')->index();
            $table->unsignedInteger('status_id')->nullable()->index();
            $table->string('address')->nullable();
            $table->string('name')->nullable();
            $table->unsignedInteger('gus_info_id')->nullable()->index();
            $table->unsignedInteger('smtp_config_id')->nullable()->index();
            $table->boolean('is_archive')->default(0);
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
        Schema::dropIfExists('clients');
    }
}
