<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIssuesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('issues', function (Blueprint $table) {
            $table->id();
            $table->string('number');
            $table->dateTime('date_application');
            $table->date('date_show_writing')->nullable();
            $table->date('date_receipt_company')->nullable();
            $table->unsignedInteger('user_id')->index();  //osoba wpisująca sprawę
            $table->string('name'); // imię i nazwisko / nazwa organizacji dla której zakładana jest sprawa
            $table->string('title');
            $table->string('number_issue');         //numer sprawy wpisywany przez nadawacę
            $table->unsignedInteger('status_id')->index();
            $table->unsignedInteger('type_id')->index();
            $table->longText('content');
            $table->string('file')->nullable();
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
        Schema::dropIfExists('issues');
    }
}
