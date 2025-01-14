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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('employee_id');

            //0 == user || 1 == admin
            $table->tinyInteger("role")->default(0);
            $table->string('position');
            $table->string('category');
            $table->string('email')->nullable();

            //0 == pending || 1 == official
            $table->tinyInteger('status')->default(0);
            $table->tinyInteger('job_status')->default(0);
            $table->string('password');
            $table->string('plain_pass');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
