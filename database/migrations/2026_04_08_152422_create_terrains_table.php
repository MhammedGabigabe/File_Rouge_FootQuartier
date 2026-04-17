<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('terrains', function (Blueprint $table) {
            $table->id();
            $table->foreignId('moderateur_id')->constrained('users')->cascadeOnDelete();
            $table->string('nom_terrain');
            $table->string('localisation');
            $table->decimal('latitude', 10, 7)->nullable();
            $table->decimal('longitude', 10, 7)->nullable();
            $table->decimal('prix',8,2);
            $table->text('description_terr')->nullable();
            $table->string('photo')->nullable();
            $table->integer('capacite');
            $table->enum('statut', ['actif', 'inactif'])->default('actif');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('terrains');
    }
};
