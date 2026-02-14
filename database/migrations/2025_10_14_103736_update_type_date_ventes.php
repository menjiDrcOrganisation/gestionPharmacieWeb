<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('ventes', function (Blueprint $table) {
            $table->dateTime('date_vente')->change();
        });
    }

    /**
     * Reverse the migrations.GGG
     */
    public function down(): void
    {
        Schema::table('ventes', function (Blueprint $table) {
            $table->date('date_vente')->change(); // ou time() si c’était le type d'origine
        });
    }
};
