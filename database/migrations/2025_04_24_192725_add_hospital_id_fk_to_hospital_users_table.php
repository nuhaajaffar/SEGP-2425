<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // only add the column & FK if it doesn't already exist
        if (! \Schema::hasColumn('hospital_users', 'hospital_id')) {
            \Schema::table('hospital_users', function (Blueprint $table) {
                $table->unsignedBigInteger('hospital_id')
                      ->after('hospital_code');
                $table->foreign('hospital_id')
                      ->references('id')
                      ->on('hospitals')
                      ->cascadeOnDelete();
            });
        }
    }
    
    public function down(): void
    {
        Schema::table('hospital_users', function (Blueprint $table) {
            $table->dropForeign(['hospital_id']);
            $table->dropColumn('hospital_id');
        });
    }
};
