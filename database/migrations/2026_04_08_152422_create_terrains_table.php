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
            $table->foreignId('moderateur_id')->constrained('users');
            $table->string('nom_terrain');
            $table->string('localisation');
            $table->decimal('prix',8,2);
            $table->text('description_terr');
            $table->string('photo');
            $table->integer('capacite');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('terrains');
    }
};
