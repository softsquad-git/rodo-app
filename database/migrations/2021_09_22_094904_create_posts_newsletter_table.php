<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsNewsletterTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts_newsletter', function (Blueprint $table) {
            $table->id();
            $table->string('number');
            $table->string('title');
            $table->dateTime('from')->nullable();
            $table->dateTime('to')->nullable();
            $table->unsignedInteger('status_id')->index();
            $table->longText('content');
            $table->boolean('is_all_clients')->default(0);
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
        Schema::dropIfExists('posts_newsletter');
    }
}
