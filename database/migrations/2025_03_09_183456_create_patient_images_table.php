<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('patient_images', function (Blueprint $table) {
            $table->id();
            // Foreign key linking to the hospital_users table (the patients)
            $table->unsignedBigInteger('hospital_user_id');
            $table->string('image_path'); // Path where the image is stored
            $table->timestamps();

            $table->foreign('hospital_user_id')
                  ->references('id')
                  ->on('hospital_users')
                  ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('patient_images');
    }
};
