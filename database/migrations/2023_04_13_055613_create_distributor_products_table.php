<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDistributorProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('distributor_products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('product_id')->constrained()->onDelete('cascade');
            $table->float('stock_on_hand', 8, 2)->nullable();
            $table->float('goods_in_transit', 8, 2)->nullable();
            $table->float('stock_on_order', 8, 2)->nullable();
            $table->float('avg_sales', 8, 2)->nullable();
            $table->boolean('overstocked')->comment('1 - Overstocked, 0 - not Overstocked')->default(0);
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
        Schema::dropIfExists('distributor_products');
    }
}
