<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\City; 

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $cities = [
            "Casablanca",
            "Rabat",
            "Marrakech",
            "Fes",
            "Tangier",
            "Agadir",
            "Meknes",
            "Oujda",
            "Kenitra",
            "Tetouan",
            "Safi",
            "Mohammedia",
            "Khouribga",
            "El Jadida",
            "Beni Mellal",
            "Nador",
            "Settat",
            "Sale",
            "Inezgane",
            "Khemisset",
            "Ouarzazate",
            "Berkane",
            "Larache",
            "Errachidia",
            "Sidi Kacem",
            "Taza",
            "Taroudant",
            "Ksar El Kebir",
            "Guelmim",
            "Sidi Slimane",
            "Youssoufia",
            "Tiznit",
            "Tan-Tan",
            "Al Hoceima",
            "Midelt",
            "Azrou",
            "Tinghir",
            "Chefchaouen",
            "Taounate",
            "Zagora",
            "Boujdour",
            "Dakhla",
            "Asilah",
            "El Aioun",
            "Ait Melloul",
            "Benslimane",
            "Boulemane",
            "Fquih Ben Salah",
            "Guercif",
            "Jerada",
            "Sefrou",
            "Smara",
            "Chichaoua",
            "El Hajeb",
            "Lqliaa",
            "Martil",
            "Oulad Teima",
            "Skhirat",
            "Ouazzane",
            "Ben Guerir",
            "Bouznika",
            "Ahfir",
            "Azemmour",
            "Sidi Ifni",
            "Oulad Ayad",
            "M'diq",
            "Fnideq",
            "Rissani",
            "Mechra Bel Ksiri",
            "Sidi Bennour",
            "Bouarfa",
            "Oulad Mbarek",
            "Missour",
            "Aknoul",
            "Ain Aouda",
            "Ait Ourir",
            "Bni Bouayach",
            "Boumia",
            "Dar Bouazza",
            "El Ksiba",
            "Laaouamra",
            "Laayoune",
            "Tamensourt",
            "Tabriquet",
            "Ahmadi",
            "Tamellalt"
        ];

        foreach ($cities as $city) {
            City::create(['name' => $city]);
        }
    }
}
