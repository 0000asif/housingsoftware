<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rents', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->unsignedBigInteger('renter_id');
            $table->date('rent_date');
            $table->unsignedBigInteger('house_id');
            $table->unsignedBigInteger('floor_id');
            $table->unsignedBigInteger('unit_id');
            $table->decimal('monthly_rent', 10, 2);
            $table->decimal('electracity_bill', 10, 2)->nullable();
            $table->decimal('water_bill', 10, 2)->nullable();
            $table->decimal('gas_bill', 10, 2)->nullable();
            $table->decimal('gatmanbill', 10, 2)->nullable();
            $table->decimal('lift_bill', 10, 2)->nullable();
            $table->string('car_reg_no')->nullable();
            $table->integer('quantity')->nullable();
            $table->decimal('garage_bill', 10, 2)->nullable();
            $table->decimal('service_charge', 10, 2)->nullable();
            $table->decimal('advance', 10, 2)->nullable();
            $table->date('close_date');
            $table->enum('rent_due', ['yes', 'no']);
            $table->tinyInteger('status');
            $table->timestamps();

            $table->foreign('renter_id')->references('id')->on('renters')->onDelete('cascade');
            $table->foreign('house_id')->references('id')->on('houses')->onDelete('cascade');
            $table->foreign('floor_id')->references('id')->on('floors')->onDelete('cascade');
            $table->foreign('unit_id')->references('id')->on('units')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rents');
    }
}
