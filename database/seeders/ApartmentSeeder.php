<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Apartment;
use Illuminate\Support\Str;

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
                'cover_img' => null,
                'show' => true,
                'user_id' => 1,
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
                'cover_img' => null,
                'show' => true,
                'user_id' => 1,
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
                'cover_img' => null,
                'show' => true,
                'user_id' => 1,
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
                'cover_img' => null,
                'show' => true,
                'user_id' => 3,
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
                'cover_img' => null,
                'show' => true,
                'user_id' => 2,
            ]
        ];

        //ciclo tutti gli elementi dell'array
        foreach ($apartments as $apartment) {
            $new_apartment = new Apartment();

            $new_apartment->title = $apartment['title'];
            $new_apartment->address = $apartment['address'];
            $new_apartment->rooms = $apartment['rooms'];
            $new_apartment->bathrooms = $apartment['bathrooms'];
            $new_apartment->beds = $apartment['beds'];
            $new_apartment->square_meters = $apartment['square_meters'];
            $new_apartment->lat = $apartment['lat'];
            $new_apartment->lon = $apartment['lon'];
            $new_apartment->cover_img = $apartment['cover_img'];
            $new_apartment->show = $apartment['show'];
            //definiamo lo slug
            $new_apartment->slug = Str::slug($apartment['title'], '-');

            $new_apartment->save();
        }
    }
}