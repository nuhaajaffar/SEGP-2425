<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('hospital_users', function (Blueprint $table) {
            // These columns are only used for patients (users with role "patient")
            $table->unsignedBigInteger('assigned_doctor_id')->nullable();
            $table->unsignedBigInteger('assigned_radiologist_id')->nullable();
            $table->unsignedBigInteger('assigned_radiographer_id')->nullable();

            // Optionally, add foreign key constraints if desired:
            $table->foreign('assigned_doctor_id')->references('id')->on('hospital_users')->onDelete('set null');
            $table->foreign('assigned_radiologist_id')->references('id')->on('hospital_users')->onDelete('set null');
            $table->foreign('assigned_radiographer_id')->references('id')->on('hospital_users')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::table('hospital_users', function (Blueprint $table) {
            $table->dropForeign(['assigned_doctor_id']);
            $table->dropForeign(['assigned_radiologist_id']);
            $table->dropForeign(['assigned_radiographer_id']);
            $table->dropColumn(['assigned_doctor_id', 'assigned_radiologist_id', 'assigned_radiographer_id']);
        });
    }
};
