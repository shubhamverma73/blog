<?php
//php artisan make:migration add_date_time_column_in_cart_details_table --table=cart_details

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDateTimeColumnInCartDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cart_details', function (Blueprint $table) {
            $table->date('date')->after('status');
            $table->date('time')->after('date');
            $table->renameColumn('created_at', 'timestamp');
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
            $table->dropColumn('date');
            $table->dropColumn('time');
            $table->dropColumn('updated_at');
        });
    }
}
