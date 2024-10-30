<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDocksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('docks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('branch_id')->constrained('branches')->onDelete('cascade');
            $table->string('document_no');
            $table->foreignId('booking_id')->nullable()->constrained('bookings')->onDelete('cascade');
            $table->string('container_no')->nullable();
            $table->string('seal_no')->nullable();
            $table->string('aes_no')->nullable();
            $table->string('type_of_moves')->nullable();
            $table->string('terminal')->nullable();
            $table->integer('container_size')->nullable();
            $table->boolean('booking_received')->default(false);
            $table->boolean('load_plan_received')->default(false);
            $table->date('loading_date')->nullable();
            $table->date('in_gate_date')->nullable();
            $table->date('departure_date')->nullable();
            $table->foreignId('client_id')->nullable()->constrained('clients')->onDelete('cascade');
            $table->foreignId('consignee_id')->nullable()->constrained('consignees')->onDelete('cascade');
            $table->integer('notify_party')->nullable();
            $table->foreignId('truck_company_id')->nullable()->constrained('truck_companies')->onDelete('cascade');
            $table->foreignId('carrier_id')->nullable()->constrained('carriers')->onDelete('cascade');
            $table->integer('vessel_name')->nullable();
            $table->integer('voyage')->nullable();
            $table->foreignId('port_id')->nullable()->constrained('ports')->onDelete('cascade');
            $table->timestamps();
        });
        Schema::table('vehicles', function (Blueprint $table) {
            $table->foreignId('dock_id')->nullable()->constrained('docks')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('docks');
        Schema::table('vehicles', function (Blueprint $table) {
            $table->dropForeign('vehicles_dock_id_foreign');
            $table->dropColumn('dock_id');
        });
    }
}
