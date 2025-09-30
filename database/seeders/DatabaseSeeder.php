<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Forme;
use App\Models\Dose;
use App\Models\Medicament;
use App\Models\Gerant;
use App\Models\Admin;
use App\Models\Pharmacie;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {

        // 🔹 Créer des Admins
        // Admin::factory(3)->create();

        // 🔹 Créer des Gérants avec Pharmacies
        Gerant::factory(5)
            ->has(Pharmacie::factory()->count(2)) // chaque gérant a 2 pharmacies
            ->create();

        // 🔹 Créer des Formes & Doses
        $formes = Forme::factory(5)->create();
        $doses = Dose::factory(5)->create();

        // 🔹 Créer des Médicaments (liés aux formes et doses existants)
        Medicament::factory(20)->make()->each(function ($medicament) use ($formes, $doses) {
            $medicament->id_forme = $formes->random()->id_forme;
            $medicament->id_dose = $doses->random()->id_dose;
            $medicament->save();
        });
    }
}
