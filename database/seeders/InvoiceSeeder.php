<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Invoice;
use Illuminate\Support\Facades\DB;

class InvoiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Générer des données de facture de manière aléatoire
        for ($i = 0; $i < 10; $i++) {
            Invoice::create([
                'repairId' => 'Réparation ' . ($i + 1),
                'additionalCharges' => rand(10, 100),
                'totalAmount' => rand(100, 1000),
            ]);
        }
    }
}
