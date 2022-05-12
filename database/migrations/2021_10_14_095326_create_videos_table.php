<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVideosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('videos', function (Blueprint $table) {
            $table->id();
            $table->integer('category_id');
            $table->integer('sub_category_id');
            $table->string('title');
            $table->string('year');
            $table->string('duration');
            $table->string('video_type');
            $table->string('url');
            $table->string('video');
            $table->string('thumbnail');
            $table->string('thumbnail_vertical');
            $table->string('video_on_off');
            $table->string('comment_on_off');
            $table->string('description');
            $table->string('is_series');
            $table->integer('series_id');
            $table->string('season_id');
            $table->string('episod_id');
            $table->string('country_id');
            $table->string('celebrity_id');
            $table->string('genre_id');
            $table->enum('status', ['inactive', 'active']);
            $table->integer('created_by');
            $table->integer('updated_by');
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
        Schema::dropIfExists('videos');
    }
}
