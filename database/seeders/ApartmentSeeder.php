<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Apartment;

use Faker\Factory as Faker;

class ApartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        foreach (range(1, 5) as $index){
            Apartment::create([
                'title' => $faker->sentence,
                'city' => $faker->city,
                'zip_code' => $faker->postcode,
                'address' => $faker->streetAddress,
                'rooms' => $faker->numberBetween(1, 5),
                'bathrooms' => $faker->numberBetween(1, 3),
                'beds' => $faker->numberBetween(1, 5),
                'square_meters' => $faker->numberBetween(20, 200),
                'lat' => $faker->latitude,
                'lon' => $faker->longitude,
                'cover_img' => $faker->imageUrl(640, 480, 'apartments', true),
                'show' => $faker->boolean,
            ]);
        }
    }
}