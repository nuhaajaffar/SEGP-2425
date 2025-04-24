<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('hospital_users', function (Blueprint $table) {
            // default pending
            $table->enum('status', ['pending','complete'])
                  ->default('pending')
                  ->after('username');
        });
    }
    
    public function down()
    {
        Schema::table('hospital_users', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }
};
