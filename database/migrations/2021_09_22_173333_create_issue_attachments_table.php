<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIssueAttachmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('issue_attachments', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('issue_id')->index();
            $table->string('number');
            $table->string('time');
            $table->unsignedInteger('user_id')->index(); // osoba wpisująca dokumnent do systemu
            $table->string('type_document'); //przychodzący / wychodzący
            $table->string('title');
            $table->longText('description')->nullable();
            $table->string('file'); // załącznik
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
        Schema::dropIfExists('issue_attachments');
    }
}

/**TODO
 * Pole time - ustalić format i prawidłowy typ kolumny
 */
