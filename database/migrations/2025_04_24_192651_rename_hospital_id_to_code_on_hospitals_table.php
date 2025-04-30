<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('hospitals', function (Blueprint $table) {
            $table->renameColumn('hospital_id', 'code');
        });
        Schema::table('hospitals', function (Blueprint $table) {
            // if you need to enforce length or nullable, do so here:
            $table->string('code')->change();
            // then add a unique index
            $table->unique('code');
        });
    }
    
    public function down(): void
    {
        Schema::table('hospitals', function (Blueprint $table) {
            $table->dropUnique(['code']);
            $table->string('code')->change();  // optional, if you changed the type
        });
        Schema::table('hospitals', function (Blueprint $table) {
            $table->renameColumn('code', 'hospital_id');
        });
    }
    
};
