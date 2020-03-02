<?php
//https://stackoverflow.com/questions/16791613/add-a-new-column-to-existing-table-in-a-migration

/*
for Laravel 3:
php artisan migrate:make add_paid_to_users

for Laravel 5+:
php artisan make:migration add_paid_to_users_table --table=users

then run you migration
php artisan migrate
*/

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddIpToTestTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('test', function (Blueprint $table) {
            $table->string('ip')->after('message');
            $table->string('browser')->after('ip');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('test', function (Blueprint $table) {
            $table->dropColumn('ip');
            $table->dropColumn('browser');
        });
    }
}
