<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('doses', function (Blueprint $table) {
            $table->id('id_dose');
            $table->decimal('quantite', 10, 2);
            $table->string('unite');
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('doses');
    }
};
