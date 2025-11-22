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
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->uuid('booking_code')->unique();
            $table->foreignId('customer_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('mitra_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('mitra_profile_id')->nullable()->constrained('mitra_profiles')->nullOnDelete();
            $table->date('scheduled_date');
            $table->time('start_time');
            $table->time('end_time')->nullable();
            $table->unsignedTinyInteger('duration_hours')->default(1);
            $table->decimal('price', 10, 2)->default(0);
            $table->enum('status', [
                'pending',
                'approved',
                'awaiting_payment',
                'paid',
                'rejected',
                'cancelled',
                'completed',
            ])->default('pending');
            $table->enum('meeting_type', ['online', 'offline'])->default('online');
            $table->string('location')->nullable();
            $table->text('notes')->nullable();
            $table->enum('payment_status', ['unpaid', 'pending', 'paid', 'failed', 'refunded'])->default('unpaid');
            $table->timestamp('payment_due_at')->nullable();
            $table->timestamp('chat_opened_at')->nullable();
            $table->timestamp('approved_at')->nullable();
            $table->timestamp('rejected_at')->nullable();
            $table->timestamp('cancelled_at')->nullable();
            $table->timestamp('completed_at')->nullable();
            $table->text('rejection_reason')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
