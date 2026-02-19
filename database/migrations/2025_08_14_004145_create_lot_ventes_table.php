<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('lot_vente', function (Blueprint $table) {
            $table->integer('quantite_vendu')->nullable();
            $table->decimal('montant', 10, 2)->nullable();
            $table->foreignId('id_lot')->constrained('lots', 'id_lot');
            $table->foreignId('id_vente')->constrained('ventes', 'id_vente');
            $table->primary(['id_lot', 'id_vente']);
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('lot_vente');
    }
};
