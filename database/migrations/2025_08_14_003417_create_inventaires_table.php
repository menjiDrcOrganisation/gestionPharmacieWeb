<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('inventaires', function (Blueprint $table) {
            $table->id('id_inventaire');
            $table->date('date_inventaire');
            $table->foreignId('id_type_inventaire')->constrained('type_inventaires', 'id_type_inventaire');
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('inventaires');
    }
};
