<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $services = [
            "Automobile MONO",
            "Recouvrement",
            "Sinistres Risques Divers Et Prévoyance",
            "Production Flotte",
            "Production Risques Divers Et Prévoyance",
        ];

        foreach ($services as $service) {
            Service::create(['name' => $service]);
        }
    }
}
