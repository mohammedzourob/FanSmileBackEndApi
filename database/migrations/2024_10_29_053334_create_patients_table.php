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
        Schema::create('patients', function (Blueprint $table) {
            $table->id();
            $table->string('firstName');
            $table->string('lastName');
            $table->bigInteger('idNumber')->unique();
            $table->integer('patientNumber')->unique();
            $table->enum('bloodType',['A+','A-','B+','B-','O+','o-','AB+','AB-','unknown']);
            $table->enum('gender',['male','female','unknown']);
            $table->string('address');
            $table->bigInteger('phone');
            $table->date('dob');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patients');
    }
};