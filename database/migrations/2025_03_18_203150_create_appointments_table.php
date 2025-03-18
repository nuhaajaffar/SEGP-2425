<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            // Patient information
            $table->string('full_name');
            $table->date('dob');
            $table->string('ic');
            $table->text('address');
            $table->string('username');
            // Foreign keys for staff assignments
            $table->unsignedBigInteger('doctor_id');
            $table->unsignedBigInteger('radiologist_id')->nullable();
            $table->unsignedBigInteger('radiographer_id')->nullable();
            // Appointment date and time
            $table->dateTime('appointment_date');
            $table->timestamps();

            // Optional: add foreign key constraints if your users are in hospital_users table
            $table->foreign('doctor_id')->references('id')->on('hospital_users')->onDelete('cascade');
            $table->foreign('radiologist_id')->references('id')->on('hospital_users')->onDelete('set null');
            $table->foreign('radiographer_id')->references('id')->on('hospital_users')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('appointments');
    }
};
