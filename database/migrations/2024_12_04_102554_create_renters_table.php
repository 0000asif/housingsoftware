<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRentersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('renters', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('name'); // Renter Name
            $table->string('email')->nullable(); // Email
            $table->string('nid'); // NID
            $table->string('phone'); // Phone
            $table->string('gender'); // Gender
            $table->date('birth_date')->nullable(); // Date of Birth
            $table->string('regnumber')->nullable(); // Birth Registration Number
            $table->string('occupation'); // Occupation
            $table->string('institute')->nullable(); // Institute Name
            $table->text('other_info')->nullable(); // Other Info
            $table->text('address'); // Permanent Address
            $table->tinyInteger('status'); // Permanent Address
            $table->timestamps(); // Created At & Updated At
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('renters');
    }
}
