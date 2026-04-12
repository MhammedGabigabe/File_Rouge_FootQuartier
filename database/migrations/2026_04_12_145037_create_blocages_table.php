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
        Schema::create('blocages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('moderateur_id')
                ->references('id')->on('users')->cascadeOnDelete();
            $table->foreignId('joueur_id')
                ->references('id')->on('users')->cascadeOnDelete();
            $table->foreignId('terrain_id')->constrained()->cascadeOnDelete();
            $table->text('raison')->nullable();
            $table->unique(['moderateur_id', 'joueur_id', 'terrain_id']); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blocages');
    }
};
