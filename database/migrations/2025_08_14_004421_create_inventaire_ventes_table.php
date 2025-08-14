<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('inventaire_vente', function (Blueprint $table) {
            $table->foreignId('id_vente')->constrained('ventes', 'id_vente');
            $table->foreignId('id_inventaire')->constrained('inventaires', 'id_inventaire');
            $table->primary(['id_vente', 'id_inventaire']);
        });
    }

    public function down(): void {
        Schema::dropIfExists('inventaire_vente');
    }
};
