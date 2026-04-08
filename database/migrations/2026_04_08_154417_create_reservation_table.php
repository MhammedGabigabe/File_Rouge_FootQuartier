<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('reservation', function (Blueprint $table) {
            $table->id();
            $table->foreignId('member_id')->constrained('users');
            $table->foreignId('terrain_id')->constrained();
            $table->datetime('heure_debut');
            $table->datetime('heure_fin');
            $table->datetime('date_res');
            $table->enum('statut', ['confirmee', 'annulee'])->default('confirmee');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('reservation');
    }
};
