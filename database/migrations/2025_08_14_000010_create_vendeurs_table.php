<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('vendeurs', function (Blueprint $table) {
            $table->id('id_vendeur');
            $table->foreignId('id_utilisateur')->constrained('utilisateurs', 'id_utilisateur');
            $table->foreignId('id_pharmacie')->constrained('pharmacies', 'id_pharmacie');
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('vendeurs');
    }
};
