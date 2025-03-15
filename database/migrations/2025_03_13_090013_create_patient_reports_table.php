<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('patient_reports', function (Blueprint $table) {
            $table->id();
            // Foreign key linking to the hospital_users table (i.e. the patient)
            $table->unsignedBigInteger('hospital_user_id');
            $table->string('report_path'); // path where the PDF report is stored
            $table->timestamps();

            $table->foreign('hospital_user_id')
                  ->references('id')
                  ->on('hospital_users')
                  ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('patient_reports');
    }
};
