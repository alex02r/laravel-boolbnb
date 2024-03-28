<?php

namespace Database\Seeders;

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
                'duration' => 0,
                'price' => 2.99 
            ],
            [
                'title' => 'Media',
                'duration' => 0,
                'price' => 5.99 
            ],
            [
                'title' => 'Pro',
                'duration' => 0,
                'price' => 9.99 
            ]
        ];
    }
}
