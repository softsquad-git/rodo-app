<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDatasetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('datasets', function (Blueprint $table) {
            $table->id();
            $table->string('number');
            $table->string('name');
            $table->unsignedInteger('type_id')->index(); //typ - tradycyjny, elektroniczny, mieszany
            $table->unsignedInteger('type_2_id')->index(); // rodzaj - (Prowadzony u ADO, Prowadzony u PP, Współadministrowanie, Mieszany)
            $table->unsignedInteger('category_people_id')->index();
            $table->integer('category_data');
            $table->text('category_data_description')->nullable();
            $table->longText('description')->nullable();
            $table->string('processing');
            $table->text('purpose_processing');
            $table->string('data_retention_set'); //Retencja danych w zbiorze
            $table->string('data_source');
            $table->string('estimated_data'); // szacowana ilość danych
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
        Schema::dropIfExists('datasets');
    }
}
