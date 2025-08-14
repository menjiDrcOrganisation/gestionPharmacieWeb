<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('pharmacies', function (Blueprint $table) {
            $table->id('id_pharmacie');
            $table->string('nom');
            $table->string('adresse');
            $table->string('telephone');
            $table->float('indice')->nullable();
            $table->foreignId('id_gerant')->constrained('gerants', 'id_gerant');
            $table->enum('statut', ['en_attente', 'valide', 'ferme'])->default('en_attente');
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('pharmacies');
    }
};
