<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRentAdjustmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rent_adjustments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('rent_id')->constrained('rents')->onDelete('cascade');
            $table->foreignId('renter_id')->constrained('renters')->onDelete('cascade');
            $table->dateTime('adjustment_date');
            $table->integer('month');
            $table->integer('year');
            $table->decimal('monthly_rent', 10, 2);
            $table->decimal('electracity_bill', 10, 2)->nullable();
            $table->decimal('water_bill', 10, 2)->nullable();
            $table->decimal('gas_bill', 10, 2)->nullable();
            $table->decimal('gatmanbill', 10, 2)->nullable();
            $table->decimal('lift_bill', 10, 2)->nullable();
            $table->decimal('garage_bill', 10, 2)->nullable();
            $table->decimal('service_charge', 10, 2)->nullable();
            $table->text('note')->nullable();
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
        Schema::dropIfExists('rent_adjustments');
    }
}
