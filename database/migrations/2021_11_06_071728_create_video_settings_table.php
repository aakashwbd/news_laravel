<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVideoSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('video_settings', function (Blueprint $table) {
            $table->id();
            $table->string('show_page');
            $table->integer('category_id')->nullable();
            $table->integer('sub_category_id')->nullable();
            $table->string('name');
            $table->enum('vertical_image', ['on', 'off'])->nullable();
            $table->enum('horizontal_image', ['on', 'off'])->nullable();
            $table->string('video_number')->nullable();
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
        Schema::dropIfExists('video_settings');
    }
}
