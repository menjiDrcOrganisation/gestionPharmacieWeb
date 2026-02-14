<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('pharmacie_medicament', function (Blueprint $table) {
            $table->foreignId('id_pharmacie')->constrained('pharmacies', 'id_pharmacie');
            $table->foreignId('id_medicament')->constrained('medicaments', 'id_medicament');
            $table->primary(['id_pharmacie', 'id_medicament']);
        });
    }

    public function down(): void {
        Schema::dropIfExists('pharmacie_medicament');
    }
};
