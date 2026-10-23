<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('sms_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('registration_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('event_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('sent_by')->nullable()->constrained('users')->nullOnDelete();
            $table->string('to_phone', 30);
            $table->string('recipient_name')->nullable();
            $table->text('message');
            $table->unsignedSmallInteger('message_length')->default(0);
            $table->string('status', 20)->default('sent'); // sent|failed
            $table->text('error')->nullable();
            $table->string('batch_id', 40)->nullable()->index();
            $table->timestamps();

            $table->index(['status', 'created_at']);
            $table->index('to_phone');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sms_logs');
    }
};
