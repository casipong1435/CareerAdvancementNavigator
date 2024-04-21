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
        Schema::create('pending_trainings', function (Blueprint $table) {
            $table->id();
            $table->string('employee_id');
            $table->string('training_id')->nullable();
            $table->string('training_title');
            $table->date('start_of_conduct');
            $table->date('end_of_conduct');
            $table->string('number_of_hours');
            $table->string('type_of_ld')->nullable();
            $table->string('source_of_budget')->nullable();
            $table->string('conducted_by')->nullable();
            $table->string('service_provider')->nullable();
            $table->string('responsible_unit')->nullable();
            $table->string('cop');
            $table->tinyInteger('status')->default(0);
            $table->string('vennue')->nullable();
            $table->string('training_type')->nullable();
            $table->string('reference')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pending_trainings');
    }
};