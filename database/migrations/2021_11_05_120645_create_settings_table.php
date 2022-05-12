<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('system_name')->nullable();
            $table->string('app_version')->nullable();
            $table->string('mail_address')->nullable();
            $table->string('update_app')->nullable();
            $table->string('developed_by')->nullable();
            $table->string('facebook')->nullable();
            $table->string('instagram')->nullable();
            $table->string('twitter')->nullable();
            $table->string('youtube')->nullable();
            $table->string('copyright');
            $table->string('logo');
            $table->text('description')->nullable();
            $table->text('privacy_policy');
            $table->text('cookies_policy')->nullable();
            $table->text('terms_policy');
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
        Schema::dropIfExists('settings');
    }
}