<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Apartment;

class ApartmentSeeder extends Seeder
{
    public function run()
    {
        $apartments = [
            [
                'title' => 'Appartamento Luminoso Centro Storico',              
                'address' => 'Via Roma 10',
                'rooms' => 3,
                'bathrooms' => 2,
                'beds' => 3,
                'square_meters' => 120,
                'lat' => 41.9028,
                'lon' => 12.4964,
                'cover_img' => 'null',
                'show' => true,
            ],
            [
                'title' => 'Attico Vista Mare',
                'address' => 'Via Napoli 20',
                'rooms' => 4,
                'bathrooms' => 2,
                'beds' => 4,
                'square_meters' => 150,
                'lat' => 40.8518,
                'lon' => 14.2681,
                'cover_img' => 'null',
                'show' => true,
            ],
            [
                'title' => 'Casa Rustica in Campagna',
                'address' => 'Strada Provinciale 10',
                'rooms' => 5,
                'bathrooms' => 3,
                'beds' => 5,
                'square_meters' => 200,
                'lat' => 43.7696,
                'lon' => 11.2558,
                'cover_img' => 'null',
                'show' => true,
            ],
            [
                'title' => 'Loft Moderno',
                'address' => 'Via Milano 30',
                'rooms' => 2,
                'bathrooms' => 1,
                'beds' => 2,
                'square_meters' => 90,
                'lat' => 45.4642,
                'lon' => 9.1900,
                'cover_img' => 'null',
                'show' => true,
            ],
            [
                'title' => 'Bilocale Centro Città',
                'address' => 'Via Torino 40',
                'rooms' => 1,
                'bathrooms' => 1,
                'beds' => 1,
                'square_meters' => 50,
                'lat' => 45.0703,
                'lon' => 7.6869,
                'cover_img' => 'null',
                'show' => false,
            ]
        ];

        Apartment::insert($apartments);
    }
}