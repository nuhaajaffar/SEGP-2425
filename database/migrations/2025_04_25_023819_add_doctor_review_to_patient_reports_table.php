<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('patient_reports', function (Blueprint $table) {
            $table->text('doctor_review')->nullable()->after('report_path');
        });
    }

    public function down(): void
    {
        Schema::table('patient_reports', function (Blueprint $table) {
            $table->dropColumn('doctor_review');
        });
    }
};
