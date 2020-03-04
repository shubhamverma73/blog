<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeColumnType extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cart_details', function (Blueprint $table) {
            $table->string('order_id')->change();
            $table->string('user_id')->change();
            $table->string('product_id')->change();            
            $table->string('car_id')->change();
            $table->string('qty')->change();
            $table->string('amount')->change();
            $table->renameColumn('car_id', 'cat_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('cart_details', function (Blueprint $table) {
            //
        });
    }
}
