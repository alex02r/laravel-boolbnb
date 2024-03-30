<?php

namespace Database\Seeders;

use App\Models\Sponsor;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SponsorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sponsors = [
            [
                'title' => 'Base',
                'duration' => 24,
                'price' => 2.99 
            ],
            [
                'title' => 'Media',
                'duration' => 72,
                'price' => 5.99 
            ],
            [
                'title' => 'Avanzata',
                'duration' => 144,
                'price' => 9.99 
            ]
        ];

        foreach ($sponsors as $sponsor) {
            $new_sponsor = new Sponsor();
            $new_sponsor->title = $sponsor['title'];
            $new_sponsor->duration = $sponsor['duration'];
            $new_sponsor->price = $sponsor['price'];
            $new_sponsor->save();
        }
    }
}
