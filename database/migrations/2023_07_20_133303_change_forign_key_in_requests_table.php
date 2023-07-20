<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use function Symfony\Component\String\b;

class ChangeForignKeyInRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('requests', function (Blueprint $table) {
            $table->dropForeign('requests_gin_no_foreign');
            $table->dropColumn('gin_no');
            $table->foreignId('gin_no')->references('id')->on('distributor_products');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('requests', function (Blueprint $table) {
            $table->dropForeign(['gin_no']);
            $table->dropColumn('gin_no');
            $table->foreignId('gin_no')->references('id')->on('products');
        });
    }
}
