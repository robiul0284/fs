<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStockMovesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stock_moves', function (Blueprint $table) {
            $table->integer('product_id')->unsigned();
            $table->decimal('quantity');
            $table->integer('from_godowns')->unsigned();
            $table->integer('to_godowns')->unsigned();
            $table->timestamps();
            $table->foreign('product_id')->references('id')->on('products');
            $table->foreign('from_godowns')->references('id')->on('godowns');
            $table->foreign('to_godowns')->references('id')->on('godowns');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stock_moves');
    }
}
