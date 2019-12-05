<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('news__news', function (Blueprint $table) {
            $table->bigIncrements('id');
//            $table->bigIncrements('category_id')->unsigned();
            $table->text('title');
            $table->string('image', 250);
            $table->text('description');
            $table->string('status', 20);
            $table->string('post_type', 20);
            $table->dateTime('published_at')->nullable();
            $table->date('event_started_at')->nullable();
            $table->date('event_ended_at')->nullable();
            $table->string('post_on', 250)->nullable();
            $table->string('slider_image', 60);
            $table->tinyInteger('featured')->default(0);
            $table->string('poster_image', 250);
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
        Schema::dropIfExists('news__news');
    }
}
