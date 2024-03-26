<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('reservations', function (Blueprint $table) {
            $table->id('reservation_id');
            $table->bigInteger('rs_voucher');
            $table->bigInteger('rs_passengers');
            $table->string('rs_travel_type', 255)->nullable();
            $table->string('rs_approval_status', 20)->nullable();
            $table->string('rs_status', 20)->nullable();
            $table->unsignedBigInteger('event_id');
            $table->unsignedBigInteger('driver_id');
            $table->unsignedBigInteger('vehicle_id');
            $table->unsignedBigInteger('requestor_id');
            $table->foreign('event_id')->references('event_id')->on('events');
            $table->foreign('driver_id')->references('driver_id')->on('drivers');
            $table->foreign('vehicle_id')->references('vehicle_id')->on('vehicles');
            $table->foreign('requestor_id')->references('requestor_id')->on('requestors');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};
