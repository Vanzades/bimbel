<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('spp_bills', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained('students')->restrictOnDelete();
            $table->decimal('amount', 12, 2);
            $table->unsignedTinyInteger('month');
            $table->unsignedSmallInteger('year');
            $table
                ->enum('status', [
                    'paid',
                    'unpaid',
                    'pending',
                    'failed',
                    'expired',
                ])
                ->default('unpaid');
            $table->timestamp('paid_at')->nullable();
            $table->string('payment_reference')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();

            $table->unique(['student_id', 'month', 'year'], 'spp_bills_student_period_unique');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('spp_bills');
    }
};
