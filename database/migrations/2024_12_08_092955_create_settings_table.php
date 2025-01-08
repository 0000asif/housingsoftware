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
            $table->foreignId('user_id')->constrained('users')->cascadeOnUpdate();
            $table->string('logo');
            $table->string('fav_icon');
            $table->string('site_title');
            $table->mediumText('short_description');
            $table->string('helpline_number')->nullable();
            $table->string('contract_number');
            $table->string('institute_email');
            $table->string('principle_email')->nullable();
            $table->string('messenger_link');
            $table->string('fb_link')->nullable();
            $table->string('instagram_link')->nullable();
            $table->string('youtube_link')->nullable();
            $table->string('linkedin')->nullable();
            $table->mediumText('address');
            $table->mediumText('map')->nullable();
            $table->string('copyright_text');
            //meta seciton
            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->string('keywords')->nullable();
            $table->string('meta_url')->nullable();
            $table->string('meta_img')->nullable();
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
