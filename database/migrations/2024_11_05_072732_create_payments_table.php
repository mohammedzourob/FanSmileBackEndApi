<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('appointmentId')->nullable()->unique();
            $table->unsignedBigInteger('operationId')->nullable()->unique();
            $table->integer('totalAmount');
            $table->integer('firstAmount');
            $table->integer('lastAmountPaid');
            $table->integer('remainingAmount');
            $table->foreign('appointmentId')->references('id')->on('appointments')->onDelete('cascade');
            $table->foreign('operationId')->references('id')->on('operations')->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};