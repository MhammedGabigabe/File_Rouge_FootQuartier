<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('terrain_id')->constrained()->cascadeOnDelete();
            $table->datetime('date_debut');
            $table->datetime('date_fin');
            $table->decimal('montant', 10, 2);
            $table->string('stripe_payment_id')->nullable();
            $table->enum('statut', ['en_attente', 'confirmee', 'expiree'])->default('en_attente');
            $table->datetime('date_res');
            $table->boolean('rappel_envoye')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('reservation');
    }
};
