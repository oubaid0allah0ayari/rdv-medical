<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->id();
            // L'expéditeur (User : ça peut être un patient ou un médecin)
            $table->foreignId('sender_id')->constrained('users')->cascadeOnDelete();
            // Le destinataire (User : ça peut être un patient ou un médecin)
            $table->foreignId('receiver_id')->constrained('users')->cascadeOnDelete();
            
            $table->text('content');
            $table->boolean('is_read')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('messages');
    }
};
