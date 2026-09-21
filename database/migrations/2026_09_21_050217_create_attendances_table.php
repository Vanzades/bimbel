<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('attendances', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained('students')->restrictOnDelete();
            $table->foreignId('schedule_id')->nullable()->constrained('schedules')->nullOnDelete();
            $table->date('date');
            $table
                ->enum('status', [
                    'present',
                    'permission',
                    'sick',
                    'absent',
                ])
                ->default('present');
            $table->text('notes')->nullable();
            $table->timestamps();

            $table->unique(['student_id', 'schedule_id', 'date'], 'attendances_student_schedule_date_unique');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('attendances');
    }
};
