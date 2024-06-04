<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Vehicule;

class VehiculeSeeder extends Seeder
{
    public function run()
    {
        Vehicule::create([
            'id' => 1,
            'mark' => 'Toyota',
            'model' => 'Corolla',
            'fuelType' => 'Essence',
            'registration' => 'ABC123',
            'photo' => 'toyota_corolla.jpg',
            'user_id' => 9,
        ]);

        Vehicule::create([
            'id' => 2,
            'mark' => 'Ford',
            'model' => 'Focus',
            'fuelType' => 'Diesel',
            'registration' => 'DEF456',
            'photo' => 'ford_focus.jpg',
            'user_id' => 12,
        ]);


    }
}
