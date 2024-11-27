<?php

namespace Database\Seeders;

use App\Models\Branche;
use App\Models\Service;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BrancheSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $branches = [
            // Sinistres Risques Divers Et Prévoyance
            "Sinistres Maladie",
            "Sinistres AT",
            "Sinistres Risques Divers Et Techniques",
            "Sinistres Manitines",
            
            // Recouvrement
            "Recouvrement à L'amiable",
            "Recouvrement Contentieux",
            
            // Automobile MONO
            "Assurance Automobile",
            "Assurance Voyage",
            
            // "Production Risques Divers Et Prévoyance"
            "Accident Du Travail",
            "Incendie - Explosion",
            "Marchandises Transportées",
            "Facultés Maritime ",
            "Multirisque Professionnelle",
            "Multirisques Industrielle",
            "DIM",
            "AMC",
            "RC Transporteur",
            "Multirisque habitations",
            "Multirisque Bureaux",
            "Bris De Machines",
            "VOL",
            "Tous Risques Chantiers",
            "Tous Risques Montage",
            "Multirisque Hôtel",
            "Multirisque Résidence",
            "Multirisque Immeuble",
            "Multirisque Café Et Restaurants",
            "Temporaire Au Décès",
            "Navigation De Plaisance",
            "Multirisque Industrielle",
            "Frais Judiciaires",
            "RC Exploitation",
            "RC Professionnelle",
            "RC Produits Livrés",
            "RC Décennale",
            "RC Sport",
            "RC Chasse",
            "RC Plaisance",
            "RC Exploitation Après Livraison",
            "RC Exploitants Restaurants Hôtels",
            "RC Scolaire",
        ];
    
        // Here, I'm grouping branches by service name
        $serviceBranches = [
            // Sinistres Risques Divers Et Prévoyance
            "Sinistres Risques Divers Et Prévoyance" => [
                "Sinistres Maladie",
                "Sinistres AT",
                "Sinistres Risques Divers Et Techniques",
                "Sinistres Manitines",
            ],
            
            // Recouvrement
            "Recouvrement" => [
                "Recouvrement à L'amiable",
                "Recouvrement Contentieux",
            ],
            
            // Automobile MONO
            "Automobile MONO" => [
                "Assurance Automobile",
                "Assurance Voyage",
            ],
            
            // Production Risques Divers Et Prévoyance
            "Production Risques Divers Et Prévoyance" => [
                "Accident Du Travail",
                "Incendie - Explosion",
                "Marchandises Transportées",
                "Facultés Maritime ",
                "Multirisque Professionnelle",
                "Multirisques Industrielle",
                "DIM",
                "AMC",
                "RC Transporteur",
                "Multirisque habitations",
                "Multirisque Bureaux",
                "Bris De Machines",
                "VOL",
                "Tous Risques Chantiers",
                "Tous Risques Montage",
                "Multirisque Hôtel",
                "Multirisque Résidence",
                "Multirisque Immeuble",
                "Multirisque Café Et Restaurants",
                "Temporaire Au Décès",
                "Navigation De Plaisance",
                "Multirisque Industrielle",
                "Frais Judiciaires",
                "RC Exploitation",
                "RC Professionnelle",
                "RC Produits Livrés",
                "RC Décennale",
                "RC Sport",
                "RC Chasse",
                "RC Plaisance",
                "RC Exploitation Après Livraison",
                "RC Exploitants Restaurants Hôtels",
                "RC Scolaire",
            ],
        ];
    
        
        foreach ($serviceBranches as $serviceName => $branchNames) {

            $service = Service::where('name', $serviceName)->first();
    
            if ($service) {
               
                foreach ($branchNames as $branchName) {
                    Branche::create([
                        'name' => $branchName,
                        'service_id' => $service->id,
                        'created_by' => null, 
                        'updated_by' => null, 
                    ]);
                }
            }
        }
    }
    
}
