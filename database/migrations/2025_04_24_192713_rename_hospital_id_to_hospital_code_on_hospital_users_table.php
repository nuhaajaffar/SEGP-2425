<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('hospital_users', function (Blueprint $table) {
            $table->renameColumn('hospital_id', 'hospital_code');
        });
        Schema::table('hospital_users', function (Blueprint $table) {
            $table->string('hospital_code')->change();
        });
    }
    public function down(): void
    {
        Schema::table('hospital_users', function (Blueprint $table) {
            $table->string('hospital_code')->change();
            $table->renameColumn('hospital_code', 'hospital_id');
        });
    }
    
};
