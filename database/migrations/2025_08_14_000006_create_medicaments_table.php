<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('medicaments', function (Blueprint $table) {
            $table->id('id_medicament');
            $table->string('nom');
            $table->text('description')->nullable();
            $table->foreignId('id_forme')->constrained('formes', 'id_forme');
            $table->foreignId('id_dose')->constrained('doses', 'id_dose');
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('medicaments');
    }
};
