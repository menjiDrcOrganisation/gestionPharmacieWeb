<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('lots', function (Blueprint $table) {
            $table->id('id_lot');
            $table->string('numero_lot');
            $table->integer('prix_achat');
            $table->integer('quantite');
            $table->integer('prix_unitaire');
            $table->date('date_expiration');
            $table->foreignId('id_medicament')->constrained('medicaments', 'id_medicament');
            $table->foreignId('id_pharmacie')->constrained('pharmacies', 'id_pharmacie');
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('lots');
    }
};
