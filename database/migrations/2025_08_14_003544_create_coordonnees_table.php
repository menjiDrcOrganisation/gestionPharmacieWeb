<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('coordonnees', function (Blueprint $table) {
            $table->id('id_coordonner');
            $table->float('latitude');
            $table->float('longitude');
            $table->foreignId('id_pharmacie')->constrained('pharmacies', 'id_pharmacie');
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('coordonnees');
    }
};
