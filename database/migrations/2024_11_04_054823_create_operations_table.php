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
        Schema::create('operations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('userId');
            $table->unsignedBigInteger('patientId');
            $table->integer('operationNumber')->unique();
            $table->string('photo')->nullable();
            $table->dateTime('date');
            $table->text('details');
            $table->enum('status',['wating','done','cancelled']);
            $table->foreign('userId')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('patientId')->references('id')->on('patients')->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('operations');
    }
};