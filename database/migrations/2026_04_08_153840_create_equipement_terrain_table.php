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
        Schema::create('equipement_terrain', function (Blueprint $table) {
            $table->foreignId('terrain_id')->constrained()->onDelete('cascade');
            $table->foreignId('equipement_terrain_id')->constrained()->onDelete('cascade');
            $table->primary(['terrain_id', 'equipement_terrain_id']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('equipement_terrain');
    }
};
