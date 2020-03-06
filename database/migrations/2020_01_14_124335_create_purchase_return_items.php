<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePurchaseReturnItems extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchase_return_items', function (Blueprint $table) {
            $table->unsignedInteger('purchase_id');
            $table->unsignedInteger('product_id');
            $table->decimal('quantity');
            $table->decimal('unit_price');
            $table->timestamps();

            $table->foreign('purchase_id')->on('purchases')->references('id');
            $table->foreign('product_id')->on('products')->references('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('purchase_return_items');
    }
}
