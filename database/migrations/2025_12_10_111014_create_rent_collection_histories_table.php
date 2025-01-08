<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRentCollectionHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rent_collection_histories', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('monthly_rent_id'); // Reference to monthly_rent table
            $table->decimal('amount_paid', 40, 2);
            $table->date('payment_date');
            $table->string('payment_method')->nullable();
            $table->text('notes')->nullable();
            $table->tinyInteger('status')->default(1); // 1 for success, 0 for failed
            $table->timestamps();

            $table->foreign('rent_id')->references('id')->on('monthly_rent')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rent_collection_histories');
    }
}
