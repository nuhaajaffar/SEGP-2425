<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('hospital_users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('ic');
            $table->string('address');
            $table->string('hospital_id')->unique();  // Auto-generated 6-digit ID
            $table->string('role');
            $table->string('contact');
            $table->string('username')->unique();
            $table->string('password');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('hospital_users');
    }
};
