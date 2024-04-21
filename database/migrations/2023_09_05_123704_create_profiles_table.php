<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();
            $table->string('employee_id');

            $table->string('first_name')->nullable();
            $table->string('middle_name')->nullable();
            $table->string('last_name')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->string('age')->nullable();
            $table->string('sex')->nullable();
            $table->string('mobile_number')->nullable();
            $table->string('image')->nullable();
            $table->string('district')->nullable();
            $table->string('date_started_in_deped')->nullable();
            $table->string('years_in_service')->nullable();
            $table->string('school')->nullable();
            $table->string('pwd')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profiles');
    }
};
