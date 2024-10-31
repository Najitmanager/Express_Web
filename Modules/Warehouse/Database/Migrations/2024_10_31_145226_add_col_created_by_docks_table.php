<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColCreatedByDocksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('docks', function (Blueprint $table) {
            $table->foreignId('created_by')->nullable()->constrained('users')->onDelete('cascade');

        });
        Schema::table('vehicles', function (Blueprint $table) {
            $table->boolean('key_received')->default(false);
            $table->boolean('title_received')->default(false);

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('docks', function (Blueprint $table) {
            $table->dropForeign('docks_created_by_foreign');
            $table->dropColumn(['created_by']);
        });
        Schema::table('vehicles', function (Blueprint $table) {

            $table->dropColumn(['key_received','title_received']);
        });
    }
}
