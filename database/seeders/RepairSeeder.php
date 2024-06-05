<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Repair;
use App\Models\User;
use App\Models\Vehicule;
use Carbon\Carbon;

class RepairSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Obtenir tous les utilisateurs et véhicules disponibles dans la base de données
        $users = User::all();
        $vehicules = Vehicule::all();

        // Générer des données de réparation de manière aléatoire
        for ($i = 0; $i < 10; $i++) {
            $randomUser = $users->random();
            $randomVehicule = $vehicules->random();

            Repair::create([
                'description' => 'Réparation ' . ($i + 1),
                'status' => 'En cours',
                'start_date' => Carbon::now()->subDays(rand(1, 30)),
                'end_date' => null,
                'mecanicNotes' => 'Notes du mécanicien pour la réparation ' . ($i + 1),
                'clientNotes' => 'Notes du client pour la réparation ' . ($i + 1),
                'mecanicId' => $randomUser->id,
                'vehiculeId' => $randomVehicule->id,

            ]);
        }
    }
}
