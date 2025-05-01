<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('hospital_users', function (Blueprint $table) {
            // Drop the UNIQUE index on hospital_id
            $table->dropUnique('hospital_users_hospital_id_unique');
        });
    }

    public function down(): void
    {
        Schema::table('hospital_users', function (Blueprint $table) {
            // (If you ever roll back, re-create it)
            $table->unique('hospital_id');
        });
    }
};
