<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // If the table exists, drop it first
        if (Schema::hasTable('doctor_reviews')) {
            Schema::drop('doctor_reviews');
        }

        Schema::create('doctor_reviews', function (Blueprint $table) {
            $table->id();
            // point both to the hospital_users PK
            $table->foreignId('patient_id')
                  ->constrained('hospital_users')
                  ->cascadeOnDelete();
            $table->foreignId('doctor_id')
                  ->constrained('hospital_users')
                  ->cascadeOnDelete();
            $table->text('review');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('doctor_reviews');
    }
};
