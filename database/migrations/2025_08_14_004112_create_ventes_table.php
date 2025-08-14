<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('ventes', function (Blueprint $table) {
            $table->id('id_vente');
            $table->date('date_vente');
            $table->decimal('montant_total', 10, 2);
            $table->string('nom_client')->nullable();
            $table->foreignId('id_pharmacie')->constrained('pharmacies', 'id_pharmacie');
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('ventes');
    }
};
